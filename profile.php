<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
<div class="row">
      <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
  <div class="card-body">
    <h5 class="card-title">name</h5>
    <p class="card-text">info</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
</div>
      </div>
      <div class="col-sm-4">
        <form>
          <div class="form-group">
                <label>update info</label>
                <textarea name="intro" rows="4" cols="50" id="exampleFormControlTextarea1" placeholder="Please enter intro" required></textarea>
                <button type="submit">Update</button>
            </div>
        </form>
      </div>
</div>

</body>
</html>
