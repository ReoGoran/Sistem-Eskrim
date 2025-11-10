<h4>Edit Banner</h4>
<form method="post" enctype="multipart/form-data">
  <div class="form-group"><label>Title</label><input name="title" class="form-control" value="<?php echo $banner->title; ?>" required></div>
  <div class="form-group"><label>Link</label><input name="link" class="form-control" value="<?php echo $banner->link; ?>"></div>
  <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control-file"> <?php if($banner->image): ?><img src="<?php echo $banner->image; ?>" height="60"><?php endif; ?></div>
  <div class="form-group"><label>Active</label> <input type="checkbox" name="is_active" value="1" <?php echo $banner->is_active?'checked':''; ?>></div>
  <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?php echo $banner->sort_order; ?>"></div>
  <button class="btn btn-pink">Update</button>
</form>