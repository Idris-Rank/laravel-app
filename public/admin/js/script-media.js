$(document).ready(function () {

    console.log('Script media ready!');
    
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

	$('.btn-open-upload-media').click(function (event) {

		$('#modal-upload-media').removeClass('hidden');

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

		$('#modal-upload-media').addClass('hidden');

	});

	$('.btn-upload-media').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		const formData = new FormData();
		const files = $('[name="input_media[]"]')[0].files;

		if (files.length > 0) {

			// thisBtn.attr('disabled', 'disabled');

			thisBtn.find('span').addClass('animate-pulse').text('Loading');

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
									<div class="btn-detail-media border cursor-pointer rounded-lg overflow-hidden">
										<img data-media-id="${value.id}" class="object-cover w-full h-36"
											src="${value.guid}"
											alt="${value.title}">
									</div>
								</div>
								`);

						});

						$('#input-media').val('');

						$('#preview-media').empty().addClass('hidden');

						$('#modal-upload-media').addClass('hidden');

						$('.showing').text(parseInt($('.showing').text()) + data.medias.length);

						$('.count-media').text(data.count_media);

						thisBtn.find('span').removeClass('animate-pulse').text('Upload');

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
								<div class="btn-detail-media border cursor-pointer rounded-lg overflow-hidden">
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

	$('html').on('click', '.btn-detail-media', function (e) {

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

				let modalMediaDetail = $('#modal-detail-media');

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

		$('#modal-detail-media').addClass('hidden');

	});

	$('.btn-update-media').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let modalMediaDetail = $('#modal-detail-media');

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

	$('.btn-delete-media').click(function (e) {

		e.preventDefault();

		let thisBtn = $(this);

		let modalMediaDetail = $('#modal-detail-media');

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

					$('.btn-detail-media').find('img[data-media-id="' + mediaId + '"]').closest('.media').remove();

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

	let thisBtnMedia;

	$('.btn-open-media').click(function (e) {

		thisBtnMedia = $(this);

		$('.btn-set-media').removeClass('hidden');

		e.preventDefault();

		$('.btn-load-more-media').click();

		$('#modal-media').removeClass('hidden');

	});

	$('.btn-close-media').click(function (e) {

		e.preventDefault();

		$('#modal-media').addClass('hidden');

	});

	$('.btn-set-media').click(function (e) {

		e.preventDefault();

		let mediaId = $('#modal-detail-media').find('[name="media_id"]').val();
		let url = $('#modal-detail-media').find('[name="url"]').val();

		thisBtnMedia.closest('.media').find('input').val(mediaId);
		thisBtnMedia.closest('.media').find('img').attr('src', url);
		thisBtnMedia.closest('.media').find('.image').removeClass('hidden');
		thisBtnMedia.closest('.media').find('.btn-open-media').addClass('hidden');
		thisBtnMedia.closest('.media').find('.btn-remove-image').removeClass('hidden');

		$('#modal-media').addClass('hidden');
		$('#modal-detail-media').addClass('hidden');


	});

	$('.btn-remove-image').click(function (e) {

		e.preventDefault();

		$(this).closest('.media').find('input').val(0);
		$(this).closest('.media').find('img').attr('src', '');
		$(this).closest('.media').find('.image').addClass('hidden');
		$(this).closest('.media').find('.btn-open-media').removeClass('hidden');
		$(this).closest('.media').find('.btn-remove-image').addClass('hidden');

	});

});