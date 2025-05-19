$(document).ready(function () {

	console.log('Script admin ready!');

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

	try {
		var urlMediaLoadMoreDec = urlMediaLoadMore ? atob(urlMediaLoadMore.replace(token, "")) : undefined;
	} catch (error) { }

	try {
		var urlMediaDetailDec = urlMediaDetail ? atob(urlMediaDetail.replace(token, "")) : undefined;
	} catch (error) { }

	try {
		var urlMediaUpdateDec = urlMediaUpdate ? atob(urlMediaUpdate.replace(token, "")) : undefined;
	} catch (error) { }

	try {
		var urlMediaDestroyDec = urlMediaDestroy ? atob(urlMediaDestroy.replace(token, "")) : undefined;
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

						$.each(data.medias, function (key, value) {

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

						$('.showing').text(parseInt($('.showing').text()) + data.medias.length);

						$('.count-media').text(data.count_media);

					}

				},
				error: function (xhr) {
					$('#response').html("Upload gagal!");
				}
			});

		}

	});

	$('.btn-load-more-media').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let page = thisBtn.attr('data-page');

		const formData = new FormData();
		formData.append('page', page);

		thisBtn.find('span').addClass('animate-pulse').text('Loading');

		$.ajax({
			url: urlMediaLoadMoreDec,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': token
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {

				if (data.status) {

					$.each(data.medias, function (key, value) {

						$('.media-list').append(`
							<div class="media col-span-2">
								<div class="btn-media-detail border cursor-pointer rounded-lg overflow-hidden">
									<img data-media-id="${value.id}" class="object-cover w-full h-36"
										src="${value.guid}"
										alt="${value.title}">
								</div>
							</div>
						`);

					});

					thisBtn.attr('data-page', parseInt(page) + 1);

					$('.showing').text(parseInt($('.showing').text()) + data.medias.length);

					$('.count-media').text(data.count_media);

					thisBtn.find('span').removeClass('animate-pulse').text('Load more');

				}

			},
			error: function (xhr) {
				$('#response').html("Upload gagal!");
			}
		});

	});

	$('html').on('click', '.btn-media-detail', function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let mediaId = thisBtn.find('img').attr('data-media-id');

		$.ajax({
			url: urlMediaDetailDec,
			type: 'GET',
			data: {
				media_id: mediaId
			},
			success: function (data) {

				let modalMediaDetail = $('#modal-media-detail');

				if (data.status) {

					modalMediaDetail.removeClass('hidden');

					modalMediaDetail.find('img').attr('src', data.media.guid);
					modalMediaDetail.find('img').attr('alt', data.media.title);
					modalMediaDetail.find('[name="media_id"]').val(data.media.id);
					modalMediaDetail.find('[name="title"]').val(data.media.title);
					modalMediaDetail.find('[name="slug"]').val(data.media.slug);
					modalMediaDetail.find('[name="caption"]').val(data.media.excerpt);
					modalMediaDetail.find('[name="url"]').val(data.media.guid);
					modalMediaDetail.find('.upload-by').text(data.media.user.name);
					modalMediaDetail.find('.upload-at').text(data.media.created_at);
					modalMediaDetail.find('.type').text(data.media.type);

				}

				console.log(data);

			},
			error: function (xhr) {
				$('#response').html("Upload gagal!");
			}
		});

	});

	$('.btn-close-media-detail').click(function (e) {

		e.preventDefault();

		$('#modal-media-detail').addClass('hidden');

	});

	$('.btn-media-update').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let modalMediaDetail = $('#modal-media-detail');

		let mediaId = modalMediaDetail.find('[name="media_id"]').val();
		let mediaTitle = modalMediaDetail.find('[name="title"]').val();
		let mediaSlug = modalMediaDetail.find('[name="slug"]').val();
		let caption = modalMediaDetail.find('[name="caption"]').val();

		const formData = new FormData();
		formData.append('_method', 'PUT');
		formData.append('media_id', mediaId);
		formData.append('title', mediaTitle);
		formData.append('slug', mediaSlug);
		formData.append('caption', caption);

		thisBtn.find('span').addClass('animate-pulse').text('Loading');

		$.ajax({
			url: urlMediaUpdateDec + '/' + mediaId,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': token
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {

				if (data.status) {

					thisBtn.find('span').removeClass('animate-pulse').text('Update');

				}

			},
			error: function (xhr) {
				$('#response').html("Upload gagal!");
			}
		});

	});

	$('.btn-media-delete').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let modalMediaDetail = $('#modal-media-detail');

		let mediaId = modalMediaDetail.find('[name="media_id"]').val();

		const formData = new FormData();
		formData.append('_method', 'DELETE');
		formData.append('media_id', mediaId);

		thisBtn.find('span').addClass('animate-pulse').text('Loading');

		$.ajax({
			url: urlMediaDestroyDec + '/' + mediaId,
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': token
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {

				if (data.status) {

					modalMediaDetail.addClass('hidden');

					thisBtn.find('span').removeClass('animate-pulse').text('Delete');

					$('.showing').text(parseInt($('.showing').text()) - 1);

					$('.count-media').text(data.count_media);

					$('.btn-media-detail').find('img[data-media-id="' + mediaId + '"]').remove();

				}

			},
			error: function (err, textStatus, errorThrown) {
				let response = err.responseJSON;

				if (response && response.message) {
					alert('Error: ' + response.message);
				} else {
					alert('Terjadi kesalahan: ' + errorThrown);
				}

				console.error('Detail error:', err);
			}

		});

	});

});