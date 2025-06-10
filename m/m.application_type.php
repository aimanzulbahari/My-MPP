<form name="ApplicationType" id="ApplicationType" method="post" class="form-horizontal" onsubmit="return false">
                    <div id="divApplicationType" class="row">    
                        <?php
                        ViewApplicationType::form_ApplicationType($_REQUEST);
                        ?>
                    </div>
                </form>