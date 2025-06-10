<form name="ApplicationList" id="ApplicationList" method="post" class="form-horizontal" onsubmit="return false">
                    <div id="divApplicationList" class="row">    
                        <?php
                        ViewApplicationList::form_ApplicationList($_REQUEST);
                        ?>
                    </div>
                </form>