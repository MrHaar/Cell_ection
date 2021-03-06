@section('content')

<?php
$nbcol = 2;
$nombre_ligne = ceil(count($genes)/$nbcol);

function validGSEA($pval){
  if($pval < 0.01)
    {
      $class = 'class="valid-GSEA"';
      return $class;
    }
  elseif ($pval < 0.05) {
      $class = 'class="hypothetical-valid-GSEA"';
      return $class;
  }
}

?>

<script type="text/javascript">
//Exportation of data selected
//Table result
var $table = $('#table');
  $(function () {
      $('#toolbar').find('select').change(function () {
          $table.bootstrapTable('refreshOptions', {
              exportDataType: $(this).val()
          });
      });
  })

      var trBoldBlue = $("table");

  $(trBoldBlue).on("click", "tr", function (){
          $(this).toggleClass("bold-blue");
  });

function linkFormatter(value)
{
    return '<a href="/gene/'+value+'">'+value+'</a>';
}
function linkFormatterCell(value)
{
    return '<a href="/cell/'+value+'">'+value+'</a>';
}
 function imgFormatter(value) 
 {
    return '<img src="/images/'+value+'.png"/>';
}
  function commFormatter(value) 
{
    return '<pre>'+value+'</pre>';
}
</script>

<div class="content-wrapper">
 	<div class="container">


    <ul class="nav nav-tabs" id="Tabs">
      <li class="active">
        <a data-toggle="tab" href="#MenuGene">Genes</a>
      </li>
      <li>
        <a data-toggle="tab" href="#MenuES">Enrichment score</a>
      </li>
    </ul>

   		<div class="tab-content" id="TabContent">

   			<!-- First Menu -->
      		<div id="MenuGene" class="tab-pane fade active in">
        		<div class="col-xs-12" id="cell">
          			<h1><?php echo $datum->name; ?></h1>
			            <blockquote class="blockquote">
			            	<h4>There are <?=count($genes);?> genes involved in this pathway.</h4>
			              	<p><i>More informations are available on the Broad Institute website.</i><a href="http://software.broadinstitute.org/gsea/msigdb/cards/<?=$datum->name; ?>" class="glyphicon glyphicon-info-sign" target="_blank"></a></p>
			            </blockquote>

				          <table id="table" 
				            data-toggle="table"
				            data-search="true"
				            data-filter-control="true" 
				            data-show-export="true"
				            data-click-to-select="true"
				            data-toolbar="#toolbar"
				            data-sortable="true"
				            data-sort-order="asc"
				            data-sort-name="hugo"
				            data-show-pagination-switch="true"
							data-pagination="true"
							data-page-list="[10, 25, 50, 100, ALL]"
							data-response-handler="responseHandler"
							data-show-refresh="true"
							class="table table-striped table-bordered"
				            >
					        <thead>
					        <tr>
					            <th data-field="hugo" data-formatter="linkFormatter" data-filter-control="input" data-sortable="true">Gene Symbol</th>
					            <th data-field="gene_title" data-filter-control="input" data-sortable="true">Gene Title</th>
					            <th data-field="entrez" data-filter-control="input" data-sortable="true">Gene Entrez ID</th>
					        </tr>
					        </thead>    
					        <tbody>
					          	<?php foreach ($genes as $gene) : ?>
						            <tr>
						                  <td><?php echo $gene->hugo; ?></td>
						                  <td><?php echo $gene->gene_title; ?></td>
						                  <td><?php echo $gene->entrez; ?></td>
						            </tr>
					          	<?php endforeach; ?>
					        </tbody>
					     </table>
				</div>
			</div>


			<!-- Second Menu -->
      		<div id="MenuES" class="tab-pane">
        		<div class="col-xs-12" id="cell">
          			<h1><?php echo $datum->name; ?></h1>
			            <blockquote class="blockquote">
							<h4><?php echo $datum->name; ?> is enrich in <?=count($ES);?> cell line(s).</h4>
      						<h3><span  class="glyphicon glyphicon-info-sign"></span> Click <a href="http://www.gsea-msigdb.org/gsea/doc/GSEAUserGuideFrame.html?_Interpreting_GSEA_Results" target="_blank">here</a> to see more informations about GSEA results.</h3>
      						<h3>You will find <a href="/GSEA/parameters">here</a> more informations about our GSEA analysis' parameters.</h3>						
			            </blockquote>

				          <table id="table" 
				            data-toggle="table"
				            data-search="true"
				            data-filter-control="true" 
				            data-show-export="true"
				            data-click-to-select="true"
				            data-toolbar="#toolbar"
				            data-sortable="true"
				            data-sort-order="asc"
				            data-sort-name="cell"
				            data-show-pagination-switch="true"
							data-pagination="true"
							data-page-list="[10, 25, 50, 100, ALL]"
							data-response-handler="responseHandler"
							data-show-refresh="true"
							class="table table-striped table-bordered"
				            >
					        <thead>
					        <tr>
				                <th data-field="cell" data-formatter="linkFormatterCell">Cell line</th>
				                <th data-field="size" data-sortable="true">Size</th>
				                <th data-field="ES" data-sortable="true">Enrichment Score</th>
				                <th data-field="NES" data-sortable="true">Normalize ES</th>
				                <th data-field="pval" data-sortable="true">Nominale p-value</th>
				                <th data-field="FDR" data-sortable="true">FDR</th>
				                <th data-field="FWER" data-sortable="true">FWER</th>
				                <th data-field="rank_at_max" data-sortable="true">Rank at max</th>
				                <!-- <th data-field="Leading EDGE" colspan=3 data-sortable="true">Leading EDGE</th> -->
				                <th data-field="Tags" data-sortable="true">Tags</th>
				                <th data-field="List" data-sortable="true">List</th>
				               <th data-field="Signal" data-sortable="true">Signal</th>
					        </tr>
					        </thead>    
					        <tbody>
					            <?php foreach ($ES as $oneES) : ?>
					                <tr <?php echo validGSEA($oneES->NOMpval); ?>>
					                    <td><?php echo $oneES->name; ?></td>
					                    <td><?php echo $oneES->size; ?></td>
					                    <td><?php echo $oneES->ES; ?></td>
					                    <td><?php echo $oneES->NES; ?></td>
					                    <td><?php echo $oneES->NOMpval; ?></td>
					                    <td><?php echo $oneES->FDRqval; ?></td>
					                    <td><?php echo $oneES->FWERqval; ?></td>
					                    <td><?php echo $oneES->rank_at_max; ?></td>
					                    <td><?php echo $oneES->tags; ?></td>
					                    <td><?php echo $oneES->list; ?></td>
					                    <td><?php echo $oneES->signal; ?></td>
					                </tr>
					            <?php endforeach; ?>
					        </tbody>
					     </table>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection