@extends('master')
@section('title')
{{ __('Chat') }}
@endsection
@section('content')
    <style>
        .chat-box .toogle-bar {
            display: none;
        }

        .chat-box .chat-menu {
            max-width: 340px;
        }

        .chat-box .people-list .search {
            position: relative;
        }

        .chat-box .people-list .search .form-control {
            background-color: #f1f4fb;
            border: 1px solid #f6f7fb;
        }

        .chat-box .people-list .search .form-control::-webkit-input-placeholder {
            color: #aaaaaa;
        }

        .chat-box .people-list .search .form-control::-moz-placeholder {
            color: #aaaaaa;
        }

        .chat-box .people-list .search .form-control:-ms-input-placeholder {
            color: #aaaaaa;
        }

        .chat-box .people-list .search .form-control::-ms-input-placeholder {
            color: #aaaaaa;
        }

        .chat-box .people-list .search .form-control::placeholder {
            color: #aaaaaa;
        }

        .chat-box .people-list .search i {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 14px;
            color: #e8ebf2;
        }

        .chat-box .people-list ul {
            padding: 0;
            list-style-type: none;
        }

        .chat-box .people-list ul li {
            padding-bottom: 20px;
        }

        .chat-box .people-list ul li:last-child {
            padding-bottom: 0;
        }

        .chat-box .user-image {
            float: left;
            width: 52px;
            height: 52px;
            margin-right: 5px;
        }

        .chat-box .about {
            float: left;
            margin-top: 5px;
            padding-left: 10px;
        }

        .chat-box .about .name {
            color: #2a3142;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .chat-box .status {
            color: #aaaaaa;
            letter-spacing: 1px;
            font-size: 12px;
            margin-top: 5px;
        }

        .chat-box .status .chat-status {
            font-weight: 600;
            color: #313131;
        }

        .chat-box .status p {
            font-size: 14px;
        }

        .chat-box .chat-right-aside .chat .chat-header {
            padding: 15px;
            border-bottom: 1px solid #f6f7fb;
        }

        .chat-box .chat-right-aside .chat .chat-header img {
            float: left;
            width: 50px;
            height: 50px;
            -webkit-box-shadow: 1px 1px 4px 1px #e8ebf2;
            box-shadow: 1px 1px 4px 1px #e8ebf2;
        }

        .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons {
            margin-top: 15px;
        }

        .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons li {
            margin-right: 24px;
        }

        .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons li a i {
            color: #777777;
            font-size: 25px;
            cursor: pointer;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box {
            padding: 20px;
            overflow-y: auto;
            height: 560px;
            margin-bottom: 90px;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .chat-user-img {
            margin-top: -35px;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .message-data {
            margin-bottom: 10px;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .message-data-time {
            letter-spacing: 1px;
            font-size: 12px;
            color: #aaaaaa;
            font-family: work-Sans, sans-serif;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .message {
            color: #2a3142;
            padding: 20px;
            line-height: 1.9;
            letter-spacing: 1px;
            font-size: 14px;
            margin-bottom: 30px;
            width: 50%;
            position: relative;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .my-message {
            border: 1px solid #f6f7fb;
            border-radius: 10px;
            border-top-left-radius: 0;
        }

        .chat-box .chat-right-aside .chat .chat-msg-box .other-message {
            background-color: #f6f6f6;
            border-radius: 10px;
            border-top-right-radius: 0;
        }

        .chat-box .chat-right-aside .chat .chat-message {
            padding: 20px;
            border-top: 1px solid #f1f4fb;
            position: absolute;
            width: calc(100% - 15px);
            background-color: #fff;
            bottom: 0;
        }

        .chat-box .chat-right-aside .chat .chat-message .smiley-box {
            background: #eff0f1;
            padding: 10px;
            display: block;
            border-radius: 4px;
            margin-right: 0.5rem;
        }

        .chat-box .chat-right-aside .chat .chat-message .text-box {
            position: relative;
        }

        .chat-box .chat-right-aside .chat .chat-message .text-box .input-txt-bx {
            height: 50px;
            border: 2px solid #4466f2;
            padding-left: 18px;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .chat-box .chat-right-aside .chat .chat-message .text-box i {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 20px;
            color: #e8ebf2;
            cursor: pointer;
        }

        .chat-box .chat-right-aside .chat .chat-message .text-box .btn {
            font-size: 16px;
            font-weight: 500;
        }

        .chat-box .chat-menu {
            border-left: 1px solid #f6f7fb;
        }

        .chat-box .chat-menu .tab-pane {
            padding: 0 15px;
        }

        .chat-box .chat-menu ul li .about .status i {
            font-size: 10px;
        }

        .chat-box .chat-menu .user-profile {
            margin-top: 30px;
        }

        .chat-box .chat-menu .user-profile .user-content h5 {
            margin: 25px 0;
        }

        .chat-box .chat-menu .user-profile .user-content hr {
            margin: 25px 0;
        }

        .chat-box .chat-menu .user-profile .user-content p {
            font-size: 16px;
        }

        .chat-box .chat-menu .user-profile .image {
            position: relative;
        }

        .chat-box .chat-menu .user-profile .image .icon-wrapper {
            position: absolute;
            bottom: 0;
            left: 55%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 35px;
            width: 35px;
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
            overflow: hidden;
            margin: 0 auto;
            font-size: 14px;
            -webkit-box-shadow: 1px 1px 3px 1px #f6f7fb;
            box-shadow: 1px 1px 3px 1px #f6f7fb;
        }

        .chat-box .chat-menu .user-profile .image .avatar img {
            border-radius: 50%;
            border: 5px solid #f6f7fb;
        }

        .chat-box .chat-menu .user-profile .border-right {
            border-right: 1px solid #f6f7fb;
        }

        .chat-box .chat-menu .user-profile .follow {
            margin-top: 0;
        }

        .chat-box .chat-menu .user-profile .follow .follow-num {
            font-size: 22px;
            color: #000;
        }

        .chat-box .chat-menu .user-profile .follow span {
            color: #1b252a;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .chat-box .chat-menu .user-profile .social-media a {
            color: #aaaaaa;
            font-size: 15px;
            padding: 0 7px;
        }

        .chat-box .chat-menu .user-profile .chat-profile-contact p {
            font-size: 14px;
            color: #aaaaaa;
        }

        .chat-box .chat-menu .nav {
            margin-bottom: 20px;
        }

        .chat-box .chat-menu .nav-tabs .nav-item {
            width: 33.33%;
        }

        .chat-box .chat-menu .nav-tabs .nav-item a {
            padding: 15px !important;
            color: #aaaaaa !important;
            letter-spacing: 1px;
            font-size: 14px;
            font-weight: 600;
            height: 80px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .chat-box .chat-menu .nav-tabs .nav-item .material-border {
            border-width: 1px;
            border-color: #4466f2;
        }

        .chat-box .chat-menu .nav-tabs .nav-item .nav-link.active {
            color: #000 !important;
        }

        .chat-box .chat-history .call-content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-width: 300px;
        }

        .chat-box .chat-history .total-time h2 {
            font-size: 50px;
            color: #eff0f1;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .chat-box .chat-history .receiver-img {
            margin-top: 55px;
        }

        .chat-box .chat-history .receiver-img img {
            border-radius: 5px;
        }

        .chat-box .chat-history .call-icons {
            margin-bottom: 35px;
        }

        .chat-box .chat-history .call-icons ul li {
            width: 60px;
            height: 60px;
            border: 1px solid #f6f7fb;
            border-radius: 50%;
            padding: 12px;
        }

        .chat-box .chat-history .call-icons ul li+li {
            margin-left: 10px;
        }

        .chat-box .chat-history .call-icons ul li a {
            color: #999;
            font-size: 25px;
        }

        .chat-left-aside>.media {
            margin-bottom: 15px;
        }

        .chat-left-aside .people-list {
            height: 625px;
        }

        .chat-left-aside ul li {
            position: relative;
        }

        .status-circle {
            width: 10px;
            height: 10px;
            position: absolute;
            top: 40px;
            left: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .away {
            background-color: #ff9f40;
        }

        .online {
            background-color: #22af47;
        }

        .offline {
            background-color: #ff5370;
        }

        .chat-container .aside-chat-left {
            width: 320px;
        }

        .chat-container .chat-right-aside {
            width: 320px;
        }

        .call-chat-sidebar {
            max-width: 320px;
        }

        .call-chat-sidebar .card .card-body,
        .chat-body .card .card-body {
            padding: 15px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col call-chat-sidebar col-sm-12">
                <div class="card">
                    <div class="card-body chat-body">
                        <div class="chat-box">
                            <!-- Chat left side Start-->
                            <div class="chat-left-aside">
                                <div class="media">
                                    @if (!empty(\App\Models\User::getUserInfo($user_session->id)->profile_photo))
                                        <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($user_session->id)->profile_photo; ?>"
                                            class="personal-avatar rounded-circle" width="50px" height="50px"
                                            alt="avatar" id="profileImagePreview">
                                    @else
                                        <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                            style="width: 50px; height: 50px;">
                                    @endif
                                    <div class="about">
                                        <div class="name f-w-600">{{ $user_session->name }}</div>
                                        <div class="status">Status...</div>
                                    </div>
                                </div>
                                <div class="people-list" id="people-list">
                                    <div class="search">
                                        <form class="theme-form">
                                            <div class="mb-3">
                                                <input class="form-control" type="text" placeholder="search"><i
                                                    class="fa fa-search"></i>
                                            </div>
                                        </form>
                                    </div>
                                    <ul class="list">
                                        @foreach ($users as $user)
                                            <li class="clearfix"
                                                onclick="openChat('{{ $user->id }}', '{{ $user->name }}', '{{ !empty(\App\Models\User::getUserInfo($user->id)->profile_photo) ? asset('profile_photo/' . \App\Models\User::getUserInfo($user->id)->profile_photo) : asset('149071.png') }}','{{ $user->last_seen }}');">
                                                @if (!empty(\App\Models\User::getUserInfo($user->id)->profile_photo))
                                                    <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($user->id)->profile_photo; ?>"
                                                        class="rounded-circle user-image" width="50px" height="50px"
                                                        alt="{{ $user->name }}">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                        style="width: 50px; height: 50px;">
                                                @endif
                                                <div class="status-circle away"></div>
                                                <div class="about">
                                                    <div class="name">{{ $user->name }}</div>
                                                    {{-- <div class="status">Hello Name</div> --}}
                                                </div>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                            <!-- Chat left side Ends-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pe-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat" style="display: none">
                                    <!-- chat-header start-->
                                    <div class="chat-header clearfix"><img class="rounded-circle"
                                            src="../assets/images/user/8.jpg" alt="">
                                        <div class="about">
                                            <div class="name"> <span class="font-primary f-12"></span></div>
                                            <div class="status digits"></div>
                                        </div>
                                        <ul class="list-inline float-start float-sm-end chat-menu-icons">
                                            <li class="list-inline-item"><a href="#"><i class="icon-search"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i class="icon-clip"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-headphone-alt"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-video-camera"></i></a></li>
                                            <li class="list-inline-item toogle-bar"><a href="#"><i
                                                        class="icon-menu"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- chat-header end-->

                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <ul id="messages-container" style="list-style-type: none;">
                                            <!-- Messages will be dynamically added here -->
                                        </ul>
                                    </div>

                                    <!-- end chat-history-->
                                    <div class="chat-message clearfix">
                                        <div class="row">
                                            <div class="col-xl-12 d-flex">
                                                <form id="chat-form">
                                                    @csrf
                                                    <input type="hidden" name="sender_id"
                                                        value="{{ Session::get('LoggedIn') }}">
                                                    <input type="hidden" class="receiver_id" name="receiver_id"
                                                        value="">
                                                    <div class="input-group text-box">
                                                        <input class="form-control input-txt-bx" id="message"
                                                            type="text" name="message" placeholder="Escribe un mensaje...">
                                                        <button class="btn btn-primary input-group-text"
                                                            type="submit">{{ __('ENVIAR') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end chat-message-->
                                    <!-- chat end-->
                                    <!-- Chat right side ends-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Submit chat message form using AJAX
            $('#chat-form').submit(function(e) {
                e.preventDefault();
                sendMessage();
            });


        });

        function fetchChatMessages() {
            let receiverId = $('.receiver_id').val();
            let senderId = "{{ Session::get('LoggedIn') }}";
            $.ajax({
                url: "{{ route('chat.messages') }}",
                method: "GET",
                data: {
                    sender_id: senderId,
                    receiver_id: receiverId
                },
                success: function(response) {
                    // Log the response for debugging
                    console.log(response);

                    // Display all messages received from the server
                    displayMessages(response.messages, senderId);

                    // Call fetchChatMessages again after a short delay (e.g., 5 seconds)
                    setTimeout(fetchChatMessages, 5000); // 5000 milliseconds = 5 seconds
                },
                error: function(xhr) {
                    console.log(xhr.responseText);

                    // Retry fetching messages after a short delay (e.g., 5 seconds)
                    setTimeout(fetchChatMessages, 5000); // 5000 milliseconds = 5 seconds
                }
            });
        }

        // Initial call to fetchChatMessages
        fetchChatMessages();


        function openChat(receiverId, receiverName, receiverImage, lastSeen) {
    // Show the chat section
    $('.chat').show();

    // Set the receiver_id
    $('.receiver_id').val(receiverId);

    // Update the chat header name
    $('.chat-header .name').text(receiverName);

    // Update the chat header image
    if (receiverImage && receiverImage.trim() !== '') {
        $('.chat-header img').attr('src', receiverImage);
        $('.chat-header img').css({
            'width': '40px',
            'height': '40px'
        });
    } else {
        $('.chat-header img').attr('src', '{{ asset('149071.png') }}');
        $('.chat-header img').css({
            'width': '40px',
            'height': '40px'
        });
    }

    // Convert the timestamp to a Date object
    var lastSeenDate = new Date(lastSeen);

    // Format the last seen time
    var lastSeenFormatted = formatDate(lastSeenDate);

    // Update the last seen status to Spanish
    $('.chat-header .status.digits').text('Última vez ' + lastSeenFormatted);

    // Fetch messages for the selected receiver
    fetchChatMessages(receiverId);
}


// Function to format date into human-readable format
function formatDate(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (0 hours)
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    // Concatenate date with time
    var formattedDateTime = date.toLocaleDateString() + ' ' + strTime;
    return formattedDateTime;
}


        function sendMessage() {
            let message = $('#message').val();
            let receiverId = $('.receiver_id').val();

            $.ajax({
                url: "{{ route('chat.send') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sender_id: "{{ Session::get('LoggedIn') }}",
                    receiver_id: receiverId,
                    message: message
                },
                success: function(response) {
                    $('#message').val(''); // Clear input field after sending message
                    fetchChatMessages(receiverId); // Fetch updated chat messages
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function displayMessages(messages, senderId) {
            // Clear previous messages
            $('.chat-history ul').empty();

            // Iterate through each message
            messages.forEach(function(message) {
                // Determine the CSS class for the message based on the sender
                let messageClass = message.sender_id == senderId ? 'my-message' : 'other-message';

                // Determine the position class for the message
                let positionClass = message.sender_id == senderId ? 'float-start' : 'float-end';

                // Determine the background color class for the message container
                let bgColorClass = message.sender_id == senderId ? 'bg-primary' : 'bg-secondary';

                // Format the message timestamp
                let messageTime = new Date(message.created_at).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Determine the profile photo URL based on the sender and receiver
                let profilePhotoUrl;

                // Handle null sender_photo gracefully (use default profile image)
                if (message.sender_photo === null) {
                    profilePhotoUrl = '{{ asset('149071.png') }}';
                } else {
                    // Construct profile photo URL with error handling
                    try {
                        profilePhotoUrl = '{{ asset('profile_photo/') }}' + '/' + message.sender_photo;
                    } catch (error) {
                        console.error('Error constructing sender profile photo URL:', error);
                        profilePhotoUrl = '{{ asset('149071.png') }}'; // Use default if error occurs
                    }
                }

                let messageHtml = `
<li>
  <div class="message ${messageClass} ">
    <img class="rounded-circle chat-user-img img-30 ${positionClass}" src="${profilePhotoUrl}" alt="" style="width: 40px; height: 40px;">
    <div class="message-data ${message.sender_id != senderId ? 'pull-right' : 'text-end'}">
      <span class="message-data-time">${messageTime}</span>
    </div>
    <div class="message-content">
      ${message.message}
    </div>
  </div>
</li>
`;

                // Append the message to the chat history container
                $('.chat-history ul').append(messageHtml);
            });
        }
    </script>
    <br>
@endsection
