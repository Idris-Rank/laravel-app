$(document).ready(function () {

	console.log('script admin ready');

	$('.btn-close-alert').click(function (event) {

		$(this).closest('.content-alert').remove();

	});

	$('.btn-toggle-password').click(function (event) {

		let thisBtn = $(this);

		let type = thisBtn.parent().find('input').attr('type');

		if (type == 'password') {

			thisBtn.parent().find('input').attr('type', 'text');

			thisBtn.parent().find('span').empty().append(`
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
						  	<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
						</svg>
				`);

		} else {

			thisBtn.parent().find('input').attr('type', 'password');

			thisBtn.parent().find('span').empty().append(`
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						</svg>
				`);

		}

	});

	let token = $('meta[name="csrf-token"]').attr('content');

	try {
		var urlMediaStoreDec = urlMediaStore ? atob(urlMediaStore.replace(token, "")) : undefined;
	} catch (error) { }

	$('.btn-open-media-upload').click(function (event) {

		$('#modal-media-upload').removeClass('hidden');

	});

	$('#input-media').on('change', function () {
		const files = this.files;

		if (files.length > 0) {
			$('#preview-media').empty().removeClass('hidden');

			Array.from(files).forEach(file => {
				const reader = new FileReader();
				reader.onload = function (e) {
					const name = file.name;
					$('#preview-media').append(`
                    <img class="w-12 h-12 object-cover border rounded-lg mr-2 mb-2"
                         src="${e.target.result}"
                         alt="${name}" title="${name}">
                `);
				};
				reader.readAsDataURL(file);
			});
		}
	});

	$('.btn-cancel-media-upload').click(function (event) {

		$('#input-media').val('');

		$('#preview-media').empty().addClass('hidden');

		$('#modal-media-upload').addClass('hidden');

	});

	$('.btn-upload-media').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		const formData = new FormData();
		const files = $('[name="input_media[]"]')[0].files;

		if (files.length > 0) {

			// thisBtn.attr('disabled', 'disabled');

			for (let i = 0; i < files.length; i++) {
				formData.append('input_media[]', files[i]);
			}

			$.ajax({
				url: urlMediaStoreDec,
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': token
				},
				data: formData,
				contentType: false,
				processData: false,
				success: function (data) {

					if (data.status) {

						$.each(data.files, function (key, value) {

							$('.media-list').prepend(`
								<div class="media col-span-2">
                        <div class="btn-media-detail border cursor-pointer rounded-lg overflow-hidden">
                            <img data-media-id="${value.id}" class="object-cover w-full h-36"
                                src="${value.guid}"
                                alt="${value.title}">
                        </div>
                    </div>
								`);

						});

						$('#input-media').val('');

						$('#preview-media').empty().addClass('hidden');

						$('#modal-media-upload').addClass('hidden');

					}

				},
				error: function (xhr) {
					$('#response').html("Upload gagal!");
				}
			});

		}

	});

});