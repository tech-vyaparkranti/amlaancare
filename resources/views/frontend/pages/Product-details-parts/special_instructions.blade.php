@if ($product->special_instructions=='yes')
    
    <div class="row" id="special_instructions_div">
        <div class="mb-4 col-md-7"  >
            <label for="special_instructions_text" class="form-label">Special Instructions</label>
            <textarea style="resize:none"   class="form-control" row="4" id="special_instructions" placeholder="Special Instructions" name="special_instructions"></textarea>
            
        </div>
    </div>
@endif