<x-pengguna.app>

    @slot('style')

    <link rel="stylesheet"
    href="{{ asset('module/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
    href="{{ asset('module/select.bootstrap4.min.css') }}">
    <link rel="stylesheet"
    href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">

    <link rel="stylesheet"
    href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    @endslot
    @slot('main')
        <!-- ======= Hero Section ======= -->
    <section id="hero-vidio-detail-playlist" class="hero-vidio-detail-playlist">


    </section><!-- End Hero -->

    <main id="main">


        <section id="content-vidio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            @foreach ($data as $item)
                            <input type="text" id="id_vidio" class="id_vidio d-none" value="{{ $item->id }}">
                            <div class="row" id="container_detail_vidio">
                            </div>
                            @endforeach
                            <div class="col-lg-12" class="container_input_comment" id="container_input_comment">

                            </div>
                            <div class="col-lg-12">
                                <div class="row" id="container_list_comment">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-list-detail-vidio">
                            <div class="card-header">
                                <h1 class="list-detail-vidio-nama-playlist"></h1>
                                <div class="d-flex justify-content-start align-items-center">
                                    <h5 class="list-detail-vidio-nama-kategori"></h5>
                                    <h4 class="list-detail-vidio-count"></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gap-2 parent_list_vidio" id="parent_list_vidio">

                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @endslot

    @slot('script')
         <script src="{{ asset('module/jquery-ui.min.js') }}"></script>
         <!-- JS Libraies -->
         <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

         <!-- Page Specific JS File -->
         <script src="{{ asset('js/page/modules-toastr.js') }}"></script>
             <!-- JS Libraies -->
         <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

         <!-- Page Specific JS File -->
         <script src="{{ asset('js/page/modules-sweetalert.js') }}"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

           <!-- JS Libraies -->
         <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
         <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
         <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
         <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
         <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
         <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
         <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
         <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
        "></script>
        <script src="https://www.youtube.com/iframe_api"></script>

        {{-- <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script> --}}
        <!-- Page Specific JS File -->
        {{-- <script src="{{ asset('js/page/modules-toastr.js') }}"></script> --}}
            <!-- JS Libraies -->
      <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var player;
      function onPlayerReady(event) {
            event.target.playVideo();
            updateDuration();
            setInterval(updateCurrentTime, 1000); // Update current time every second
        }

        function updateDuration() {
            var duration = player.getDuration();
            document.getElementById("duration-time").innerText = formatTime(duration);
        }

        function updateCurrentTime() {
            var currentTime = player.getCurrentTime();
            document.getElementById("current-time").innerText = formatTime(currentTime);
        }

        function formatTime(timeInSeconds) {
            var minutes = Math.floor(timeInSeconds / 60);
            var seconds = Math.floor(timeInSeconds % 60);
            seconds = seconds < 10 ? '0' + seconds : seconds;
            return minutes + ":" + seconds;
        }

        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                // setTimeout(stopVideo, 6000);
                setTimeout(function(){
                    get_input_comment();
                    get_rating_komen()
                }, 120000);
                done = true;
            }
        }

        function stopVideo() {
            player.stopVideo();
        }


        function get_input_comment() {
            $("#container_input_comment").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_input_comment/${id}') }}`,
                type: 'GET',
                success: function(response) {
                    if(response.data == 0){
                        $("#container_input_comment").append(`
                        <div class="card card-comment-container">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <img src="{{ asset('storage/user/${response.foto}') }}" class="img-fluid image-comment-detail-vidio" alt="">
                                                </div>
                                                <div class="col-lg-10">
                                                    <form action="" id="comment_form">
                                                        <input type="text" name="comment" id="comment" class="comment-form form-control">
                                                        <div class="d-flex">
                                                            <div class="d-flex flex-column star-card">
                                                                <label class="fa fa-star" for="rating1" onclick="handleStarClick(1)"></label>
                                                                <input type="checkbox" class="d-none" value="rating1" id="rating1" disabled>
                                                            </div>
                                                            <div class="d-flex flex-column star-card">
                                                                <label class="fa fa-star" for="rating2" onclick="handleStarClick(2)"></label>
                                                                <input type="checkbox" class="d-none" value="rating2" id="rating2" disabled>
                                                            </div>
                                                            <div class="d-flex flex-column star-card">
                                                                <label class="fa fa-star" for="rating3" onclick="handleStarClick(3)"></label>
                                                                <input type="checkbox" class="d-none" value="rating3" id="rating3" disabled>
                                                            </div>
                                                            <div class="d-flex flex-column star-card">
                                                                <label class="fa fa-star" for="rating4" onclick="handleStarClick(4)"></label>
                                                                <input type="checkbox" class="d-none" value="rating4" id="rating4" disabled>
                                                            </div>
                                                            <div class="d-flex flex-column star-card">
                                                                <label class="fa fa-star" for="rating5" onclick="handleStarClick(5)"></label>
                                                                <input type="checkbox" class="d-none" value="rating5" id="rating5" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-3">
                                                            <div class=""></div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-primary btn-batal-detail-vidio" onclick="reset_input()">Batal</button>
                                                                <button type="button" class="btn btn-primary btn-komentar-detail-vidio" id="btn-komentar-detail-vidio" onclick="aksi_tambah_comment()">komentar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `);
                    }
                }
            });
        }

        function openLoading(title_open,deskripsi_open) {
            Swal.fire({
                title: title_open,
                html: deskripsi_open,
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }

        function closeLoading() {
            Swal.close();
            // You can add additional logic here after the loading is complete
            Swal.fire({
                icon: 'success',
                title: 'Operasi Selesai',
                text: 'Proses pemuatan telah selesai!',
            });
        }
        function get_vidio_detail() {
            $("#container_detail_vidio").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_detail_vidio/${id}') }}`,
                type: 'GET',
                beforeSend: function() {
                    openLoading("Mohon Ditunggu ...!",'Sedang Load Vidio ...!')
                },
                success: function(response) {
                    Swal.close();
                    response.data.forEach(item => {
                        $("#container_detail_vidio").append(`
                            <div class="col-lg-12">
                                <h4 class="caption-minimum-vidio">Lihat vidio minimal 2 menit !!!</h4>
                            </div>
                            <div class="col-lg-12">

                                <div id="videoPlayer"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-duration-container">
                                    <div class="card-body container-duration">
                                        <span>Current Time: <span id="current-time">0:00</span></span> /
                                        <span>Duration: <span id="duration-time">0:00</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-comment-container">
                                    <div class="card-body container-deskripsi">
                                        <h1>${item.judul}</h1>
                                        <h4>${item.kategori}</h4>
                                        <p>${item.deskripsi}</p>
                                    </div>
                                </div>
                            </div>
                        `);
                        if (item.type_vidio == 'link') {
                            var videoURL = item.link;
                            // var videoId = null;
                            var videoId = null;
                            if (videoURL.includes('youtube.com')) {
                                videoId = videoURL.split('v=')[1];
                            } else if (videoURL.includes('youtu.be')) {
                                videoId = videoURL.split('.be/')[1];
                            }
                            // if (videoId) {
                            //     var embedURL = 'https://www.youtube.com/embed/"M7lc1UVf-VE';
                            //     // var embedURL = 'https://www.youtube.com/embed/' + videoId;
                            //     $('#videoPlayer').replaceWith('<iframe id="videoPlayer" class="play-vidio-detail-vidio" data-id="link" width="100%" style="height: 70vh;" src="' + embedURL + '" frameborder="0" allowfullscreen></iframe>');
                            // } else {
                            //     $('#videoPlayer').replaceWith(`<img width="100%" class="play-vidio-detail-vidio" style="height: 70vh;" id="videoPlayer" src="" alt="notfound">`);
                            // }
                            player = new YT.Player("videoPlayer", {
                                height: "390",
                                width: "640",
                                videoId: videoId,
                                playerVars: {
                                    playsinline: 1,
                                },
                                events: {
                                    onReady: onPlayerReady,
                                    onStateChange: onPlayerStateChange,
                                },
                            });
                        } else if (item.type_vidio == 'upload') {
                            $('#videoPlayer').replaceWith(`
                                <video id="videoPlayer" class="play-vidio-detail-vidio" style="height: 70vh;" data-id="upload" width="100%" controls>
                                    <source id="videoSource" src="${response.video_link}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            `);
                            var videoPlayer = document.getElementById('videoPlayer');
                            var playedTime = 0;
                            var lastTime = 0;
                            var isPlaying = false;

                            videoPlayer.addEventListener('timeupdate', function() {
                                var currentTime = videoPlayer.currentTime;
                                if (isPlaying) {
                                    playedTime += currentTime - lastTime;
                                }
                                lastTime = currentTime;

                                document.getElementById('current-time').innerText = formatTime(currentTime);
                                document.getElementById('duration-time').innerText = formatTime(videoPlayer.duration);

                                if (playedTime >= 120 && !videoPlayer.hasTriggeredTwoMinutes) {
                                    videoPlayer.hasTriggeredTwoMinutes = true;
                                    get_input_comment();
                                    get_rating_komen();
                                }
                            });

                            videoPlayer.addEventListener('pause', function() {
                                isPlaying = false;
                                lastTime = videoPlayer.currentTime;
                            });

                            videoPlayer.addEventListener('play', function() {
                                isPlaying = true;
                                lastTime = videoPlayer.currentTime;
                            });
                        }
                    });

                }
            });
        }

        function get_rating_komen() {
            $("#container_list_comment").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_rating_komen/${id}') }}`,
                type: 'GET',
                success: function(response) {
                    response.ratings.forEach(item => {
                        let starHtml = '';
                        let angka = 5 - item.bintang;
                        for (let i = 0; i < item.bintang; i++) {
                            starHtml += `<i class="fa fa-star star-comment-list" aria-hidden="true"></i>`;
                        }
                        for (let i = 0; i < angka; i++) {
                            starHtml += `<i class="fa fa-star" aria-hidden="true"></i>`;
                        }

                        let editHtml = '';
                        if(item.edit == true){
                            editHtml += `<p class="edit_comment" id="edit_comment" data-id="${item.id}" onclick="edit_comment(this)">Edit</p>`;
                        }
                        $("#container_list_comment").append(`
                            <div class="col-lg-12">
                                <div class="card card-comment-container">
                                    <div class="card-body">
                                        <div class="row gap-3">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <img src="{{ asset('storage/user/${item.foto}') }}" class="img-fluid image-comment-detail-vidio" alt="">
                                                    </div>
                                                    <div class="col-lg-10 container-isi-comment">
                                                        <h4 class="user-comment-list">${item.nama_user}<span>${item.time_ago}</span></h4>
                                                        <p class="isi-comment-list">${item.isi}</p>
                                                        <div class="d-flex rating_parent">
                                                            <p class="isi-rating-list">${starHtml}</p>
                                                            ${editHtml}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }

        function get_list_vidio() {
            $("#parent_list_vidio").empty();
            let id = $("#id_vidio").val();
            $.ajax({
                url: `{{ url('pengguna/get_list_vidio/${id}') }}`,
                type: 'GET',
                success: function(response) {
                    response.data.forEach(item => {
                        $(".list-detail-vidio-nama-playlist").html(item.nama_playlist);
                        $(".list-detail-vidio-nama-kategori").html(`${item.kategori} -`);
                        $(".list-detail-vidio-count").html(` ${response.order_of_video} / ${item.total_vidio}`);
                        let no = 0;
                        item.vidio.forEach(item2 => {
                            no += 1;

                            console.log(response.order_of_video);
                            let unlockHtml = '';
                            if(item2.unlock == false){
                                unlockHtml += `<i class="fa fa-lock me-3" style="transform: translateY(3px)" aria-hidden="true"></i>`
                                $("#parent_list_vidio").append(`
                                    <div class="col-lg-12 atasan_detail_list_vidio" id="atasan_detail_list_vidio_${no}">
                                        <div class="row">
                                            <div class="col-lg-5 d-flex align-items-start ">
                                                <img src="{{ asset('storage/vidio/${item2.thumbnail_vidio}') }}" class="img-fluid image-list-detail-vidio" alt="">
                                            </div>
                                            <div class="col-lg-6">
                                                <h4 class="caption-1-detail-vidio">{{ Str::limit('${item2.judul_vidio}', 45, '...') }}</h4>
                                                <p class="caption-2-detail-vidio">${item2.time_vidio}</p>
                                            </div>
                                            <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                ${unlockHtml}
                                            </div>
                                        </div>
                                    </div>
                                `);
                            }else{
                                $("#parent_list_vidio").append(`
                                    <div class="col-lg-12 atasan_detail_list_vidio" id="atasan_detail_list_vidio_${no}">
                                        <a href="{{ url('pengguna/detailVidio/${item2.id}') }}">
                                            <div class="row">
                                                <div class="col-lg-5 d-flex align-items-start ">
                                                    <img src="{{ asset('storage/vidio/${item2.thumbnail_vidio}') }}" class="img-fluid image-list-detail-vidio" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h4 class="caption-1-detail-vidio">{{ Str::limit('${item2.judul_vidio}', 45, '...') }}</h4>
                                                    <p class="caption-2-detail-vidio">${item2.time_vidio}</p>
                                                </div>
                                                <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                    ${unlockHtml}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                `);
                            }

                            if(no == response.order_of_video){
                                $(`#atasan_detail_list_vidio_${no}`).addClass('background-detail-list');
                            } else {
                                $(`#atasan_detail_list_vidio_${no}`).removeClass('background-detail-list');
                            }
                        });
                    });
                }
            });
        }

        function aksi_edit_comment(element){
            let id = $(element).data("id");
            // alert("masuk");
            const currentChecked = document.querySelectorAll('.star-card input:checked').length;
            var formData = new FormData($('#comment_form')[0]);
            formData.append('_method', 'PUT');
            formData.append('comment', $('#comment').val());
            formData.append('rating', currentChecked);
            $.ajax({
                url: `{{ url('pengguna/update_comment/${id}') }}`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        get_input_comment();
                        get_rating_komen();
                        get_list_vidio();
                    } else {
                        if (Array.isArray(response.error)) {
                            var errorMessages = "<ul>";
                            $.each(response.error, function (key, value) {
                                errorMessages += "<li>" + value + "</li>";
                            });
                            errorMessages += "</ul>";
                            iziToast.error({
                                message: errorMessages,
                                position: 'topRight'
                            });
                        }else{
                            iziToast.error({
                                message: response.errorgambar,
                                position: 'topRight'
                            });
                        }
                    }
                    reset_input();
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.error;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    iziToast.error({
                        title: 'Gagagal!',
                        message: errorMessages,
                        position: 'topRight'
                    });
                }
            });
        }

        function edit_comment(element) {
            let id = $(element).data("id");
            $("#edit_comment").addClass("d-none");
            $("#container_input_comment").empty();
            $.ajax({
                url: `{{ url('pengguna/edit_input_comment/${id}') }}`,
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        let starsHTML = '';
                        let angka = 5 - response.data.bintang;
                        for (let i = 1; i <= response.data.bintang; i++) {
                            starsHTML += `<div class="d-flex flex-column star-card">
                                            <label class="fa fa-star checked" for="rating${i}" onclick="handleStarClick(${i})"></label>
                                            <input type="checkbox" class="d-none" value="rating${i}" id="rating${i}" checked disabled>
                                        </div>`;
                        }

                        for (let i = 0; i < angka; i++) {
                            starsHTML += `<div class="d-flex flex-column star-card">
                                            <label class="fa fa-star" for="rating${i}" onclick="handleStarClick(${i})"></label>
                                            <input type="checkbox" class="d-none" value="rating${i}" id="rating${i}" disabled>
                                        </div>`;
                        }

                        $("#container_input_comment").append(`
                            <div class="card card-comment-container">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <img src="{{ asset('storage/user/${response.foto}') }}" class="img-fluid image-comment-detail-vidio" alt="">
                                                </div>
                                                <div class="col-lg-10">
                                                    <form action="" id="comment_form">
                                                        <input type="text" name="comment" id="comment" class="comment-form form-control" value="${response.data.isi}">
                                                        <div class="d-flex">
                                                            ${starsHTML}
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-3">
                                                            <div class=""></div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-primary btn-batal-edit-comment" onclick="batal_edit()">Batal Edit</button>
                                                                <button type="button" class="btn btn-primary btn-komentar-edit-comment" id="btn-komentar-edit-comment" data-id="${response.data.id}" onclick="aksi_edit_comment(this)">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                }
            });
        }

        function handleStarClick(rating) {
            const currentChecked = document.querySelectorAll('.star-card input:checked').length;
            const isSingleChecked = (currentChecked === 1 && document.getElementById(`rating${rating}`).checked);

            if (isSingleChecked) {
                document.getElementById(`rating${rating}`).checked = false;
                document.querySelector(`label[for="rating${rating}"]`).classList.remove('checked');
            } else {
                for (let i = 1; i <= 5; i++) {
                    const starLabel = document.querySelector(`label[for="rating${i}"]`);
                    const starInput = document.getElementById(`rating${i}`);

                    if (i <= rating) {
                        starLabel.classList.add('checked');
                        starInput.checked = true;
                    } else {
                        starLabel.classList.remove('checked');
                        starInput.checked = false;
                    }
                }
            }
        }

        function aksi_tambah_comment() {
            const currentChecked = document.querySelectorAll('.star-card input:checked').length;
            var formData = new FormData($('#comment_form')[0]);
            formData.append('comment', $('#comment').val());
            formData.append('rating', currentChecked);
            formData.append('vidio_id',$("#id_vidio").val());
            $.ajax({
                url: "{{ url('pengguna/store_comment') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Berhasil',
                            message: response.success,
                            position: 'topRight'
                        });
                        get_input_comment();
                        get_rating_komen();
                        get_list_vidio();
                    } else {
                        if (Array.isArray(response.error)) {
                            var errorMessages = "<ul>";
                            $.each(response.error, function (key, value) {
                                errorMessages += "<li>" + value + "</li>";
                            });
                            errorMessages += "</ul>";
                            iziToast.error({
                                message: errorMessages,
                                position: 'topRight'
                            });
                        }else{
                            iziToast.error({
                                message: response.errorgambar,
                                position: 'topRight'
                            });
                        }
                    }
                    reset_input();
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.error;
                    var errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                    iziToast.error({
                        title: 'Gagagal!',
                        message: errorMessages,
                        position: 'topRight'
                    });
                }
            });
        }

        function batal_edit(){
            $("#edit_comment").removeClass("d-none");
            $("#container_input_comment").empty();
            $('#comment').val("");
            $('input[type="checkbox"]').prop('checked', false);
            for (let i = 1; i <= 5; i++) {
                $(`label[for="rating${i}"]`).removeClass('checked');
            }
        }
        function reset_input(){
            $('#comment').val("");
            $('input[type="checkbox"]').prop('checked', false);
            for (let i = 1; i <= 5; i++) {
                $(`label[for="rating${i}"]`).removeClass('checked');
            }
        }

        $(document).ready(function(){
            get_vidio_detail();
            // get_input_comment();
            // get_rating_komen();
            get_list_vidio();
        });
      </script>
    @endslot
  </x-pengguna.app>
