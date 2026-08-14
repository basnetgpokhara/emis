<script type="text/javascript">

    jQuery(function($) {

        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });

        $('.bulk-action-btn').click(function () {

            $chkIds = document.getElementsByName('chkIds[]');
            var $chkCount = 0;
            $length = $chkIds.length;
            for (var $i = 0; $i < $length; $i++) {
                if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                    $chkCount++;
                }
            }

            if ($chkCount <= 0) {
                toastr.info("Please, Select At Least One Record.", "Info:");
                return false;
            }

            var $this = $(this);
            var bulk_action = $this.attr('attr-action-type');
            var form = $('#bulk_action_form');

            /*bootbox.confirm("Are you sure, You Want To "+(bulk_action).toUpperCase()+" Using Bulk Action?<br>Please, Be Sure When You Use Bulk Action. It Effects All The Selected Data.", function(result) {
                if(result) {
                    $(form).prepend('<input type="hidden" name="bulk_action" value="'+bulk_action+'">')
                    $('#bulk_action_form').submit();
                }
            });*/

            bootbox.confirm({
                    title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle orange'></i> "+(bulk_action).toUpperCase()+ " Confirmation</h4></div>",
                    message: "<div class='ui-dialog-content ui-widget-content' style='width: auto; min-height: 30px; max-height: none; height: auto;'><div class='alert alert-info bigger-110'>Are you sure, you want to "+(bulk_action).toUpperCase()+". Please, Be sure when use bulk action. It effects all the selected data.</div>" +
                    "<p class='bigger-110 bolder center grey'><i class='ace-icon fa fa-hand-o-right blue bigger-120'></i>Are you sure?</p>",
                    /*size: 'small',*/
                    buttons: {
                        confirm: {
                            label : "<i class='ace-icon fa fa-check'></i> Yes, "+(bulk_action).toUpperCase()+" Now!",
                            className: "btn-success btn-sm",
                        },
                        cancel: {
                            label: "<i class='ace-icon fa fa-remove'></i> Cancel",
                            className: "btn-primary btn-sm",
                        }
                    },
                    callback: function(result) {
                        if(result) {
                            $(form).prepend('<input type="hidden" name="bulk_action" value="'+bulk_action+'">')
                            $('#bulk_action_form').submit();
                        }
                    }
                }
            );
            return false;

        });

    })


</script>