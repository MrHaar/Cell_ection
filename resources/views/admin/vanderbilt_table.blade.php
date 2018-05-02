@section('contentadmin')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Vanderbilt Tables <small>See actual Vanderbilt classification table</small></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Class</th>
                  <th>Correlation</th>
                  <th>P-value</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($vanderbilts as $vanderbilt) : ?>
                <tr>
                  <td><?php echo $vanderbilt->id; ?></td>
                  <td><?php echo $vanderbilt->class; ?></td>
                  <td><?php echo $vanderbilt->correlation; ?></td>
                  <td><?php echo $vanderbilt->pval; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection