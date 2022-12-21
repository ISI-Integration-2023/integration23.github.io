<?php

include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/eventdata_model.php');
require_once( $ROOT_PATH.'/DAL/eventdata_dal.php');
require_once( $ROOT_PATH.'/Model/eventregistration_model.php');
require_once( $ROOT_PATH.'/DAL/eventregistration_dal.php');
class eventreg_controller
{
    static function getEventRegistration() {
        $eventid = 0;
        if (isset($_REQUEST['eventid'])){  $eventid = $_REQUEST['eventid']; }
        $eventreg_dalObj = new eventregistration_dal();
        $EventReg = $eventreg_dalObj->getEventUsers($eventid);
        $event_dalObj = new eventdata_dal();
        $event = $event_dalObj->getDatas('eventid = '.$eventid);
        $event = $event[0];
        if ($event->isactive) {
                        echo('<div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                        <tr>
                                <th style="width:25%">Name</th>
                                <th style="width:30%">Institution</th>
                                <th style="width:15%">Phone</th>
                                <th style="width:25%">Email</th>
                        </tr>
                </thead>');
        echo('<tbody>');
        if($EventReg != null && count($EventReg) > 0) {
                foreach ($EventReg as $eventregitem) {
                        echo('<tr><td style="width:25%">'.$eventregitem->userfirstname.' '.$eventregitem->userlastname.'</td>
                                <td style="width:30%">'.$eventregitem->userinstitution.'</td>
                                <td style="width:15%">'.$eventregitem->userphone.'</td>
                                <td style="width:25%">'.$eventregitem->useremail.'</td>
                        </tr>');
                }
        }
        echo('</tbody></table></div>');
        }
        else {
                echo('<div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                        <tr>
                                <th style="width:15%">Name</th>
                                <th style="width:15%">Institution</th>
                                <th style="width:10%">Phone</th>
                                <th style="width:15%">Email</th>
                                <th style="width:25%">Payment ID</th>
                                <th style="width:20%">Payment Approval</th>
                        </tr>
                </thead>');
        echo('<tbody>');
        if($EventReg != null && count($EventReg) > 0) {
                foreach ($EventReg as $eventregitem) {
                        if (($eventregitem->status) == "APPROVED") {
                                $approval_status = true;
                        }
                        else {
                                $approval_status = false;
                        }
                        echo('<tr><td style="width:15%">'.$eventregitem->userfirstname.' '.$eventregitem->userlastname.'</td>
                                <td style="width:15%">'.$eventregitem->userinstitution.'</td>
                                <td style="width:10%">'.$eventregitem->userphone.'</td>
                                <td style="width:15%">'.$eventregitem->useremail.'</td>
                                <td style="width:25%">'.$eventregitem->paymentid.'</td>
                                <td>
                                        <a class="btn btn-'.($approval_status ? "danger" : "success").' approval-btn" href="javascript:void(0)" 
                                        userreg-target='.$eventregitem->userregid.'>'.($approval_status ? "Disapprove" : "Approve").'</a>
                                </td>
                        </tr>');
                }
        }
        echo('</tbody></table></div>');

        }
    }

    static function approve() {
        if (isset($_REQUEST['userregid'])){  $userregid = $_REQUEST['userregid']; }
        if (isset($_REQUEST['approval_status'])){  $approval_status = $_REQUEST['approval_status']; }
        
        $eventreg_dalObj = new eventregistration_dal();
        $eventreg_Model = new eventregistration_model();
        
        $oldeventreg = $eventreg_dalObj->getDatas("userregid = ".$userregid);
        $oldeventreg = $oldeventreg[0];
        $userid = $oldeventreg->userid;
        $eventid = $oldeventreg->eventid;
        $paymentid = $oldeventreg->paymentid;
        
        $status = "PAID";
        if (filter_var($approval_status, FILTER_VALIDATE_BOOLEAN)) {
                $status = "DISAPPROVED";
        } else {
                $status = "APPROVED";
        }

        $eventreg_Model->userregid = $userregid;
        $eventreg_Model->userid = $userid;
        $eventreg_Model->eventid = $eventid;
        $eventreg_Model->paymentid = $paymentid;
        $eventreg_Model->status = $status;
        
        $retval = $eventreg_dalObj->updateDatas($eventreg_Model);
        return $retval;
    }
}?>


<?php 

if(isset($_REQUEST["mode"])) {
        $mode = $_REQUEST['mode'];
}

if ($mode == "getEventRegistration") {
        eventreg_controller::getEventRegistration();
}
else if ($mode == "approval") {
       $retval =  eventreg_controller::approve();
       return $retval;
}

?>





