<form class="contact-form m-t-10" id="form-contact" method="POST">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
    </div>
    <div class="form-group">
        <label for="example-email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="johndoe@email.com" required>
    </div>
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" placeholder="New York . .." required>
    </div>
    <div class="form-group">
        <label>Message</label>
        <textarea name="message"  class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
</form>
