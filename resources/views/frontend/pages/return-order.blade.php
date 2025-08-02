<form action="{{ route('returnOrder.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required>
    </div>

    <div>
        <label for="shipment_id">Shipment ID:</label>
        <input type="text" id="shipment_id" name="shipment_id" required>
    </div>

    <div>
        <label for="return_reason">Return Reason:</label>
        <textarea id="return_reason" name="return_reason" required></textarea>
    </div>

    <div>
        <label for="pickup_address">Pickup Address:</label>
        <input type="text" id="pickup_address" name="pickup_address" required>
    </div>

    <div>
        <label for="video_proof">Upload Video Proof:</label>
        <input type="file" id="video_proof" name="video_proof" accept="video/*" required>
    </div>

    <button type="submit">Submit Return Request</button>
</form>
