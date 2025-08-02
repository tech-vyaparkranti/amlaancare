@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-star" aria-hidden="true"></i> Message</h3>
                <div class="dashboard_review">
                    <div class="row">
                        <div class="col-xl-4 col-md-5">
                            <div class="chatlist d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <h2>Seller List</h2>
                                    <div class="chatlist_body">
                                        @foreach ($chatUsers as $chatUser)
                                        @php
                                            $unseenMessages = \App\Models\Chat::where(['sender_id' => $chatUser->receiverProfile->id, 'receiver_id' => auth()->user()->id, 'seen' => 0])->exists();
                                        @endphp
                                        <button class="nav-link chat-user-profile"
                                            data-id="{{ $chatUser->receiverProfile->id }}"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <div class="wsus_chat_list_img {{ $unseenMessages ? 'msg-notification' : ''}}">
                                                <img src="{{ asset($chatUser->receiverProfile->image) }}"
                                                    alt="user" class="img-fluid">
                                                <span class="pending d-none" id="pending-6">0</span>
                                            </div>
                                            <div class="wsus_chat_list_text">
                                                <h4>{{ $chatUser->receiverProfile->name }}</h4>
                                            </div>
                                        </button>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-7">
                            <div class="chat_main_area">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab">
                                        <div id="chat_box">
                                            <div class="chat_area">

                                                <div class="chat_area_header">
                                                    <h2 id="chat-inbox-title">Chat with Daniel Paul</h2>
                                                </div>
                                                <div class="chat_area_body" data-inbox="">

                                                </div>
                                                {{-- <div class="chat_area_footer" style="
                                                width: 100%;
                                                bottom: 0;">
                                                    <form id="message-form">
                                                        @csrf
                                                        <input type="text" placeholder="Type Message"
                                                            class="message-box" autocomplete="off" name="message">
                                                        <input type="hidden" name="receiver_id"
                                                            value="" id="receiver_id">
                                                        <button type="submit"><i class="fas fa-paper-plane send-button"
                                                                aria-hidden="true"></i></button>
                                                    </form>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                    <!-- Chat Footer (Input & Send Button) -->
                    {{-- <div class="chat_area_footer" style="width: 100%; bottom: 0;">
                        <form id="message-form">
                            @csrf
                            <input type="text" placeholder="Type Message" class="message-box" autocomplete="off" name="message" id="messageInput">
                            <input type="hidden" name="receiver_id" value="" id="receiver_id">
                            <button type="submit" id="sendMessageBtn">
                                <i class="fas fa-paper-plane send-button" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div> --}}


                    <!-- JavaScript for Sending Messages -->
{{-- <script>
    function formatDateTime(date) {
        const options = { hour: "2-digit", minute: "2-digit", second: "2-digit" };
        return new Date(date).toLocaleTimeString([], options);
    }

    document.getElementById("message-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const messageInput = document.getElementById("messageInput");
        const messageText = messageInput.value.trim();

        if (messageText === "") return;

        const chatMessages = document.getElementById("chatMessages");

        const messageDiv = document.createElement("div");
        messageDiv.classList.add("chat_single_text");
        messageDiv.style.background = "#f1f1f1";
        messageDiv.style.padding = "8px";
        messageDiv.style.margin = "5px 0";
        messageDiv.style.borderRadius = "5px";
        messageDiv.style.position = "relative";

        messageDiv.innerHTML = `
            <p>${messageText}</p>
            <span style="font-size: 10px; color: gray; position: absolute; bottom: 2px; right: 5px;">
                ${formatDateTime(new Date())}
            </span>
        `;

        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = "";
    });


    document.getElementById("messageInput").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.getElementById("sendMessageBtn").click();
        }
    });
</script>

<style>
.chat_area_footer form input {
    width: 100%;
    padding: 26px 20px;
    font-size: 15px;
    border: 1px solid #eee;
}

/* Tablets and below (screen width <= 768px) */
@media (max-width: 768px) {
    .chat_area_footer form input {
        padding: 25px;
        /* padding: 18px 15px;   */
        font-size: 14px;
    }

    .chat_main_area {
    height: 70vh;
    border-radius: 5px;
    background: #fff;
    box-shadow: rgba(0, 0, 0, 0.27) 0px 1px 4px;
    overflow: hidden;
}
}

/* Mobile (screen width <= 480px) */
@media (max-width: 480px) {
    .chat_area_footer form input {
        padding: 25px;
        /* padding: 14px 12px;   */
        font-size: 13px;
    }
    .chat_main_area {
    height: 72vh;
    border-radius: 5px;
    background: #fff;
    box-shadow: rgba(0, 0, 0, 0.27) 0px 1px 4px;
    overflow: hidden;
}
}


</style> --}}


                    {{-- chat message --}}

                            </div>

                             <!-- Chat Footer (Input & Send Button) -->
                    <div class="chat_area_footer" style="width: 100%; bottom: 0;">
                        <form id="message-form">
                            @csrf
                            <input type="text" placeholder="Type Message" class="message-box" autocomplete="off" name="message" id="messageInput">
                            <input type="hidden" name="receiver_id" value="" id="receiver_id">
                            <button type="submit" id="sendMessageBtn">
                                <i class="fas fa-paper-plane send-button" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>


                    <!-- JavaScript for Sending Messages -->
<script>
    function formatDateTime(date) {
        const options = { hour: "2-digit", minute: "2-digit", second: "2-digit" };
        return new Date(date).toLocaleTimeString([], options);
    }

    document.getElementById("message-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const messageInput = document.getElementById("messageInput");
        const messageText = messageInput.value.trim();

        if (messageText === "") return;

        const chatMessages = document.getElementById("chatMessages");

        const messageDiv = document.createElement("div");
        messageDiv.classList.add("chat_single_text");
        messageDiv.style.background = "#f1f1f1";
        messageDiv.style.padding = "8px";
        messageDiv.style.margin = "5px 0";
        messageDiv.style.borderRadius = "5px";
        messageDiv.style.position = "relative";

        messageDiv.innerHTML = `
            <p>${messageText}</p>
            <span style="font-size: 10px; color: gray; position: absolute; bottom: 2px; right: 5px;">
                ${formatDateTime(new Date())}
            </span>
        `;

        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = "";
    });


    document.getElementById("messageInput").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.getElementById("sendMessageBtn").click();
        }
    });
</script>

<style>
.chat_area_footer form input {
    width: 100%;
    padding: 26px 20px;
    font-size: 15px;
    border: 1px solid #eee;
}


</style>


                    {{-- chat message --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </section>
@endsection

@push('scripts')
    <script>
        const mainChatInbox = $('.chat_area_body');

        function formatDateTime(dateTimeString) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            }
            const formatedDateTime = new Intl.DateTimeFormat('en-Us', options).format(new Date(dateTimeString));
            return formatedDateTime;
        }

        function scrollTobottom() {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
        }

        $(document).ready(function(){
            $('.chat-user-profile').on('click', function(){
                let receiverId = $(this).data('id');
                let senderImage = $(this).find('img').attr('src');
                let chatUserName = $(this).find('h4').text();
                mainChatInbox.attr('data-inbox', receiverId);
                $('#receiver_id').val(receiverId);
                $(this).find('.wsus_chat_list_img').removeClass('msg-notification');
                $.ajax({
                    method: 'get',
                    url: '{{ route("user.get-messages") }}',
                    data: {
                        receiver_id: receiverId
                    },
                    beforeSend: function() {
                        mainChatInbox.html("");
                        // set chat inbox title
                        $('#chat-inbox-title').text(`Chat With ${chatUserName}`)
                    },
                    success: function(response) {

                        $.each(response, function(index, value) {

                            if(value.sender_id == USER.id) {
                                var message = `<div class="chat_single single_chat_2">
                                        <div class="chat_single_img">
                                            <img src="${USER.image}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDateTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }else {
                                var message = `<div class="chat_single">
                                        <div class="chat_single_img">
                                            <img src="${senderImage}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDateTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }


                                mainChatInbox.append(message);
                        });

                        // scroll to bottom
                        scrollTobottom();
                    },
                    error: function(xhr, status, error) {

                    },
                    complete: function() {

                    }
                })
            })

            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let messageData = $('.message-box').val();

                var formSubmitting = false;

                if(formSubmitting || messageData === "" ) {
                    return;
                }

                // set message in inbox
                let message = `
                <div class="chat_single single_chat_2">
                    <div class="chat_single_img">
                        <img src="${USER.image}"
                            alt="user" class="img-fluid">
                    </div>
                    <div class="chat_single_text">
                        <p>${messageData}</p>
                        <span></span>
                    </div>
                </div>
                `
                mainChatInbox.append(message);
                $('.message-box').val('');
                scrollTobottom()

                $.ajax({
                    method: 'POST',
                    url: '{{ route("user.send-message") }}',
                    data: formData,
                    beforeSend: function() {
                        $('.send-button').prop('disabled', true);
                        formSubmitting = true;
                    },
                    success: function(response) {

                    },
                    error: function(xhr, status, error) {
                       toastr.error(xhr.responseJSON.message);
                       $('.send-button').prop('disabled', false);
                       formSubmitting = false;
                    },
                    complete: function() {
                        $('.send-button').prop('disabled', false);
                        formSubmitting = false;
                    }
                })
            })
        })
    </script>

    <style>
     .chat_area {
    position: relative;
    height: 70vh; /* Default for larger screens */
}

/* Large Desktop (1440px and above) */
@media (min-width: 1440px) {
    .chat_area {
        height: 70vh;
    }
}

/* Medium Desktop (1200px - 1439px) */
@media (min-width: 1200px) and (max-width: 1439px) {
    .chat_area {
        height: 65vh;
    }
}

/* Small Desktop (992px - 1199px) */
@media (min-width: 992px) and (max-width: 1199px) {
    .chat_area {
        height: 60vh;
    }
}

/* Tablets and small laptops (768px - 991px) */
@media (min-width: 768px) and (max-width: 991px) {
    .chat_area {
        height: 55vh;
    }
}

/* Large phones and small tablets (576px - 767px) */
@media (min-width: 576px) and (max-width: 767px) {
    .chat_area {
        height: 50vh;
    }
}

/* Phones (up to 575px) */
@media (max-width: 575px) {
    .chat_area {
        height: 45vh;
    }
}

/* Very small phones (up to 375px) */
@media (max-width: 375px) {
    .chat_area {
        height: 40vh;
    }
}

/* Ultra small phones (up to 320px) */
@media (max-width: 320px) {
    .chat_area {
        height: 35vh;
    }
}


    </style>
@endpush
