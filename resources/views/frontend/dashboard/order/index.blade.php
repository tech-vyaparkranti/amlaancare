@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name ?? ""}} || Orders
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Orders</h3>
            <div class="dashboard_profile">
              <div class="dash_pro_area">
                {{ $dataTable->table() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="reviewPopup" class="popup-overlay">
      <div class="popup-content">
          <h3>Give Your Review</h3>
          <form action="{{route('user.review.create')}}" enctype="multipart/form-data" method="POST">
              @csrf
              <label for="rating">Rating:</label>
              <select name="rating" id="rating" required>
                  <option value="">Select Rating</option>
                  <option value="1">1 Star</option>
                  <option value="2">2 Stars</option>
                  <option value="3">3 Stars</option>
                  <option value="4">4 Stars</option>
                  <option value="5">5 Stars</option>
              </select>
  
              <!-- Image Upload -->
              <label for="reviewImages">Select Images (Max 4):</label>
              <input type="file" name="images[]" id="reviewImages" accept="image/*" multiple required>
  
              <div id="imagePreviewContainer" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>
  
              <label for="comment">Comment:</label>
              <textarea name="review" id="comment" rows="4" required></textarea>
              <input type="hidden" name="order_id" id="orderIdInput">
              <div class="popup-buttons">
                  <button type="submit" class="submit-btn">Submit</button>
                  <button type="button" id="cancelReviewBtn" class="cancel-btn">Cancel</button>
              </div>
          </form>
      </div>
  </div>
  
                <script>
                    document.getElementById("reviewImages").addEventListener("change", function(event) {
                        const previewContainer = document.getElementById("imagePreviewContainer");
                        let files = Array.from(event.target.files);
  
  
                        let currentImages = previewContainer.querySelectorAll(".image-wrapper").length;
  
  
                        if (currentImages + files.length > 4) {
                            alert("You can upload a maximum of 4 images.");
                            event.target.value = "";
                            return;
                        }
  
  
                        files.forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const imageWrapper = document.createElement("div");
                                imageWrapper.classList.add("image-wrapper");
                                imageWrapper.style.position = "relative";
                                imageWrapper.style.display = "inline-block";
  
                                const imageWrapper = document.createElement("div");
                        imageWrapper.style.position = "relative";
                        imageWrapper.style.display = "inline-block";
                        imageWrapper.style.width = "50px";
                        imageWrapper.style.height = "50px";
                        imageWrapper.style.borderRadius = "5px";
                        imageWrapper.style.overflow = "hidden";
  
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.width = "100%";
                        img.style.height = "100%";
                        img.style.objectFit = "cover";
  
                        const deleteBtn = document.createElement("button");
                        deleteBtn.innerHTML = "✖";
                        deleteBtn.style.position = "absolute";
                        deleteBtn.style.top = "2px";
                        deleteBtn.style.right = "2px";
                        deleteBtn.style.background = "red";
                        deleteBtn.style.color = "white";
                        deleteBtn.style.border = "none";
                        deleteBtn.style.borderRadius = "50%";
                        deleteBtn.style.width = "18px";
                        deleteBtn.style.height = "18px";
                        deleteBtn.style.fontSize = "12px";
                        deleteBtn.style.cursor = "pointer";
                        deleteBtn.style.display = "flex";
                        deleteBtn.style.justifyContent = "center";
                        deleteBtn.style.alignItems = "center";
                        deleteBtn.style.lineHeight = "1";
  
  
                        imageWrapper.appendChild(img);
                        imageWrapper.appendChild(deleteBtn);
  
  
                        deleteBtn.addEventListener("click", function() {
                            imageWrapper.remove();
                        });
  
  
                        document.getElementById("your-image-container").appendChild(imageWrapper);
  
  
                                imageWrapper.appendChild(img);
                                imageWrapper.appendChild(deleteBtn);
                                previewContainer.appendChild(imageWrapper);
                            };
                            reader.readAsDataURL(file);
                        });
                    });
  
  
                </script>
  <style>
  
  .popup-overlay {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 2000;
  }
  
  .popup-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    max-width: 90%;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  }
  
  /* Other styles remain the same */
  
  
  
                        input, select, textarea {
                            width: 100%;
                            padding: 8px;
                            margin: 10px 0;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                        }
  
  
                        .popup-buttons {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 15px;
                        }
  
                        .submit-btn {
                            background-color: rgb(145, 148, 201);
                            color: white;
                            padding: 10px 15px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }
  
                        .cancel-btn {
                            background-color: red;
                            color: white;
                            padding: 10px 15px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }
  
  
                        .popup-content {
                            transform: scale(0.8);
                            transition: transform 0.3s ease-in-out;
                        }
  
                        .popup-overlay.show .popup-content {
                            transform: scale(1);
                        }
  </style>
  
  
  <script>
                     
  document.body.addEventListener("click", function(event) {
    if (event.target && event.target.classList.contains("getReviewBtn")) {
        document.getElementById("reviewPopup").style.display = "flex";
        var orderId = event.target.getAttribute('data-order-id');
        document.getElementById("orderIdInput").value = orderId;
  
    }
  });
  
  document.getElementById("cancelReviewBtn").addEventListener("click", function() {
    document.getElementById("reviewPopup").style.display = "none";
  });
  
  
  
  </script>


  </section>
  <!--=============================
    DASHBOARD END
  ==============================-->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
