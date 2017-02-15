<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/footer.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/navbar.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
<!-- Datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--<script>
    $("#datepicker").datepicker({
        beforeShowDay: function (date) {
            return [date.getDay() == 0 || date.getDay() == 5 || date.getDay() == 6, ""]
        },
        minDate: 0
    });

</script>-->
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
        jQuery("select[name='offered_courses']").change(function () {

            var ajaxLoader = "<img src='../ajax-loader.gif' alt='loading...' />";
            // get the selected option value of offered_courses
            var optionValue = jQuery("select[name='offered_courses']").val();

            /**
             * pass offered_courses value through POST method
             * the 'status' parameter is only a dummy parameter (just to show how multiple parameters can be passed)
             * if we get response from php file, then only the crnAjax div is displayed 
             * otherwise the cityAjax div remains hidden
             */
            jQuery("#crnAjax")
                    //.html(ajaxLoader)
                    .load('process_crn.php', {offered_course: optionValue, status: 1}, function (response) {
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




<script>
    function edit_row(id)
    {
        var date_submitted = document.getElementById("date_submitted_val" + id).innerHTML;
        var fname = document.getElementById("fname_val" + id).innerHTML;
        var lname = document.getElementById("lname_val" + id).innerHTML;
        var HCC_phone = document.getElementById("HCC_phone_val" + id).innerHTML;
        var other_phone = document.getElementById("other_phone_val" + id).innerHTML;
        var delivered_campus = document.getElementById("delivered_campus_val" + id).innerHTML;
        var home_campus = document.getElementById("home_campus_val" + id).innerHTML;
        var course = document.getElementById("course_val" + id).innerHTML;
        var crn = document.getElementById("crn_val" + id).innerHTML;
        var term = document.getElementById("term_val" + id).innerHTML;
        var pptw = document.getElementById("pptw_val" + id).innerHTML;
        var pppd = document.getElementById("pppd_val" + id).innerHTML;
        var ppts = document.getElementById("ppts_val" + id).innerHTML;
        var oltw = document.getElementById("oltw_val" + id).innerHTML;
        var olpd = document.getElementById("olpd_val" + id).innerHTML;
        var olts = document.getElementById("olts_val" + id).innerHTML;
        var exam_instructions = document.getElementById("exam_instructions_val" + id).innerHTML;
        var special_instructions = document.getElementById("special_instructions_val" + id).innerHTML;

        document.getElementById("date_submitted_val" + id).innerHTML = "<input type='text' id='date_submitted_text" + id + "' value='" + date_submitted + "'>";
        document.getElementById("fname_val" + id).innerHTML = "<input  type='text' id='fname_text" + id + "' value='" + fname + "'>";
        document.getElementById("lname_val" + id).innerHTML = "<input  type='text' id='lname_text" + id + "' value='" + lname + "'>";
        document.getElementById("HCC_phone_val" + id).innerHTML = "<input  type='text' id='HCC_phone_text" + id + "' value='" + HCC_phone + "'>";
        document.getElementById("other_phone_val" + id).innerHTML = "<input  type='text' id='other_phone_text" + id + "' value='" + other_phone + "'>";
        document.getElementById("delivered_campus_val" + id).innerHTML = "<input  type='text' id='delivered_campus_text" + id + "' value='" + delivered_campus + "'>";
        document.getElementById("home_campus_val" + id).innerHTML = "<input  type='text' id='home_campus_text" + id + "' value='" + home_campus + "'>";
        document.getElementById("course_val" + id).innerHTML = "<input  type='text' id='course_text" + id + "' value='" + course + "'>";
        document.getElementById("crn_val" + id).innerHTML = "<textarea id='crn_text" + id + "'>" + crn.replace(/<br\s*[\/]?>/gi, "\n");
        document.getElementById("term_val" + id).innerHTML = "<input  type='text' id='term_text" + id + "' value='" + term + "'>";
        document.getElementById("pptw_val" + id).innerHTML = "<input  type='text' id='pptw_text" + id + "' value='" + pptw + "'>";
        document.getElementById("pppd_val" + id).innerHTML = "<input  type='text' id='pppd_text" + id + "' value='" + pppd + "'>";
        document.getElementById("ppts_val" + id).innerHTML = "<input  type='text' id='ppts_text" + id + "' value='" + ppts + "'>";
        document.getElementById("oltw_val" + id).innerHTML = "<input type='text' id='oltw_text" + id + "' value='" + oltw + "'>";
        document.getElementById("olpd_val" + id).innerHTML = "<input  type='text' id='olpd_text" + id + "' value='" + olpd + "'>";
        document.getElementById("olts_val" + id).innerHTML = "<input  type='text' id='olts_text" + id + "' value='" + olts + "'>";
        document.getElementById("exam_instructions_val" + id).innerHTML = "<textarea id='exam_instructions_text" + id + "'>" + exam_instructions.replace(/<br\s*[\/]?>/gi, "\n");
        document.getElementById("special_instructions_val" + id).innerHTML = "<textarea type='text' id='special_instructions_text" + id + "'>" + special_instructions.replace(/<br\s*[\/]?>/gi, "\n");

        document.getElementById("edit_button" + id).style.display = "none";
        document.getElementById("save_button" + id).style.display = "block";
    }

    function save_row(id)
    {
        /*
         * var name = document.getElementById("name_text" + id).value;
         var age = document.getElementById("age_text" + id).value;
         * 
         */

        var date_submitted = document.getElementById("date_submitted_text" + id).value;
        var fname = document.getElementById("fname_text" + id).value;
        var lname = document.getElementById("lname_text" + id).value;
        var HCC_phone = document.getElementById("HCC_phone_text" + id).value;
        var other_phone = document.getElementById("other_phone_text" + id).value;
        var delivered_campus = document.getElementById("delivered_campus_text" + id).value;
        var home_campus = document.getElementById("home_campus_text" + id).value;
        var course = document.getElementById("course_text" + id).value;
        var crn = document.getElementById("crn_text" + id).value;
        var term = document.getElementById("term_text" + id).value;
        var pptw = document.getElementById("pptw_text" + id).value;
        var pppd = document.getElementById("pppd_text" + id).value;
        var ppts = document.getElementById("ppts_text" + id).value;
        var oltw = document.getElementById("oltw_text" + id).value;
        var olpd = document.getElementById("olpd_text" + id).value;
        var olts = document.getElementById("olts_text" + id).value;
        var exam_instructions = document.getElementById("exam_instructions_text" + id).value;
        var special_instructions = document.getElementById("special_instructions_text" + id).value;

        $.ajax
                ({
                    type: 'post',
                    url: 'modify_records.php',
                    data: {
                        edit_row: 'edit_row',
                        row_id: id,
                        date_submitted_val: date_submitted,
                        fname_val: fname,
                        lname_val: lname,
                        HCC_phone_val: HCC_phone,
                        other_phone_val: other_phone,
                        delivered_campus_val: delivered_campus,
                        home_campus_val: home_campus,
                        course_val: course,
                        crn_val: crn,
                        term_val: term,
                        pptw_val: pptw,
                        pppd_val: pppd,
                        ppts_val: ppts,
                        oltw_val: oltw,
                        olpd_val: olpd,
                        olts_val: olts,
                        exam_instructions_val: exam_instructions,
                        special_instructions_val: special_instructions
                    },
                    success: function (response) {
                        if (response == "success")
                        {
                            /*
                             document.getElementById("name_val" + id).innerHTML = name;
                             document.getElementById("age_val" + id).innerHTML = age;
                             */

                            document.getElementById("date_submitted_val" + id).innerHTML = date_submitted;
                            document.getElementById("fname_val" + id).innerHTML = fname;
                            document.getElementById("lname_val" + id).innerHTML = lname;
                            document.getElementById("HCC_phone_val" + id).innerHTML = HCC_phone;
                            document.getElementById("other_phone_val" + id).innerHTML = other_phone;
                            document.getElementById("delivered_campus_val" + id).innerHTML = delivered_campus;
                            document.getElementById("home_campus_val" + id).innerHTML = home_campus;
                            document.getElementById("course_val" + id).innerHTML = course;
                            document.getElementById("crn_val" + id).innerHTML = crn;
                            document.getElementById("term_val" + id).innerHTML = term;
                            document.getElementById("pptw_val" + id).innerHTML = pptw;
                            document.getElementById("pppd_val" + id).innerHTML = pppd;
                            document.getElementById("ppts_val" + id).innerHTML = ppts;
                            document.getElementById("oltw_val" + id).innerHTML = oltw;
                            document.getElementById("olpd_val" + id).innerHTML = olpd;
                            document.getElementById("olts_val" + id).innerHTML = olts;
                            document.getElementById("exam_instructions_val" + id).innerHTML = exam_instructions;
                            document.getElementById("special_instructions_val" + id).innerHTML = special_instructions;

                            document.getElementById("edit_button" + id).style.display = "unset";
                            document.getElementById("save_button" + id).style.display = "none";

                        }
                    }
                });
    }

    function delete_row(id)
    {
        $.ajax
                ({
                    type: 'post',
                    url: 'modify_records.php',
                    data: {
                        delete_row: 'delete_row',
                        row_id: id,
                    },
                    success: function (response) {
                        if (response == "success")
                        {
                            var row = document.getElementById("row" + id);
                            row.parentNode.removeChild(row);
                        }
                    }
                });
    }


</script>
