<div class="mb-3">
    <label> Name</label>
    <input type="text" name="name" placeholder="user name" class="form-control" value="{{ $client->name}}" />
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" placeholder="example@gmail.com" class="form-control"
        value="{{ $client->email }}" />
</div>

<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" placeholder="example_gaza" class="form-control" value="{{ $client->address }}" />
</div>

<div class="mb-3">
    <label>phone</label>
    <input type="text" name="phone" placeholder="+972597854778" class="form-control" value="{{ $client->phone }}" />
</div>

<div class="mb-3">
    <label>Status</label>
    <select class="form-select" name="status" aria-label="Default select example">
        <option value="active">active</option>
        <option value="inactive">inactive</option>
      </select>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control" />
    @if ($client->image)
    <img width="80" src="{{ asset('uploads/clients/'.$client->image) }}">
    @endif
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea id="mytextarea" name="description" placeholder="Description" class="form-control" rows="5">{{ $client->description }}</textarea>
</div>




