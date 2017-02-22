<!-- Bootstrap core CSS -->
<!--================================================== -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/footer.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/navbar.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="js/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<script>
    $(function () {
        $("#datepicker").datepicker({
            beforeShowDay: function (date) {
                return [date.getDay() == 0 || date.getDay() == 5 || date.getDay() == 6, ""]
            },
            minDate: 0
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#online-option').attr('readonly', 'readonly');
        $('select[name="test-online"]').on('change', function () {
            var others = $(this).val();
            if (others == "Yes") {
                $('#online-option').removeAttr('readonly');
            } else {
                $('#online-option').attr('readonly', 'readonly');
            }

        });



    });
</script>
<script>
    $(document).ready(function () {
        $('select[name*="paper_proctor_date"]').change(function () {


            // start by setting everything to enabled
            $('select[name*="paper_proctor_date"] option').attr('disabled', false);

            // loop each select and set the selected value to disabled in all other selects
            $('select[name*="paper_proctor_date"]').each(function () {
                var $this = $(this);
                $('select[name*="paper_proctor_date"]').not($this).find('option').each(function () {
                    if ($(this).attr('value') == $this.val())
                        $(this).attr('disabled', true);
                });
            });

        });
    });
</script>  
<script>
    $(document).ready(function () {
        $('select[name*="online_proctor_date"]').change(function () {


            // start by setting everything to enabled
            $('select[name*="online_proctor_date"] option').attr('disabled', false);

            // loop each select and set the selected value to disabled in all other selects
            $('select[name*="online_proctor_date"]').each(function () {
                var $this = $(this);
                $('select[name*="online_proctor_date"]').not($this).find('option').each(function () {
                    if ($(this).attr('value') == $this.val())
                        $(this).attr('disabled', true);
                });
            });

        });
    });
</script>  
<script>
    $(document).ready(function () {
        $('#modal-dialog').on('show', function () {
            var link = $(this).data('link'),
                    confirmBtn = $(this).find('.confirm');
        })
        $('#btnYes').click(function () {

            // handle form processing here


            $('form').submit();

        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        // when any option from offered_courses list is selected
        //jQuery("select[name='offered_courses']").change(function () {
        jQuery("select[name='term']").change(function () {
            var ajaxLoader = "<img src='../ajax-loader.gif' alt='loading...' />";
            // get the selected option value of offered_courses
            //  var optionValue = jQuery("select[name='offered_courses']").val();
            var optionValue = jQuery("select[name='term']").val();
            var course = jQuery("select[name='offered_courses']").val();
            var semester = "6172";

            /**
             * pass offered_courses value through POST method
             * the 'status' parameter is only a dummy parameter (just to show how multiple parameters can be passed)
             * if we get response from php file, then only the crnAjax div is displayed 
             * otherwise the cityAjax div remains hidden
             */
            jQuery("#crnAjax")
                    //.html(ajaxLoader)
                    .load('process_crn.php', {term: optionValue, semester: semester, course: course, status: 1}, function (response) {
                        if (response) {
                            jQuery("#crnAjax").css('display', '');
                            //jQuery("#crnAjax").css('disabled, '');
                        } else {
                            jQuery("#crnAjax").css('display', 'none');
                            //jQuery("#crnAjax").css('display', 'true');
                        }
                    });
        });
    });
</script>
<script>
    $(document).ready(function () {
        var activeSystemClass = $('.list-group-item.active');

        //something is entered in search form
        $('#system-search').keyup(function () {
            var that = this;
            // affect all table rows on in systems table
            var tableBody = $('.table-list-search tbody');
            var tableRowsClass = $('.table-list-search tbody tr');
            $('.search-sf').remove();
            tableRowsClass.each(function (i, val) {

                //Lower text for case insensitive
                var rowText = $(val).text().toLowerCase();
                var inputText = $(that).val().toLowerCase();
                if (inputText != '')
                {
                    $('.search-query-sf').remove();
                    tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                            + $(that).val()
                            + '"</strong></td></tr>');
                } else
                {
                    $('.search-query-sf').remove();
                }

                if (rowText.indexOf(inputText) == -1)
                {
                    //hide rows
                    tableRowsClass.eq(i).hide();

                } else
                {
                    $('.search-sf').remove();
                    tableRowsClass.eq(i).show();
                }
            });
            //all tr elements are hidden
            if (tableRowsClass.children(':visible').length == 0)
            {
                tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function (e) {
        $("#test-online").change(function (e) {
            if ($("#test-online").val() == 'No') {
                $("input[name^='online']").removeAttr('disabled');
                $("select[name^='online']").attr('disabled', 'disabled');
            } else {
                $("select[name^='online']").removeAttr('disabled');
                $("input[name^='online']").attr('disabled', 'disabled');
            }
        });
        $("#test-online").trigger('change');
    });
</script>





