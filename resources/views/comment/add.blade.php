<section class="add-comment">
    <form action="{{ url('/api/comment') }}" method="post" class="js-add-comment-form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="author">Name*:</label>
            <input type="text" class="form-control col-6" id="author" name="author" max="255" required>
            <span class="js-error-label"></span>
        </div>
        <div class="form-group">
            <label for="content">Text*:</label>
            <textarea name="content" id="content" rows="3" class="form-control col-6" required></textarea>
            <span class="js-error-label"></span>
        </div>

        {{ $slot }}

        <button type="submit" class="btn btn-primary js-add-comment-btn">Add comment</button>
    </form>
</section>
