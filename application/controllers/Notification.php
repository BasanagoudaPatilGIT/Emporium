<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller 
{

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Notification_model');
		$this->load->library('encrypt');	
		
	}
	
	public function viewPendingNotificationDetails() { //working as expected. 
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$Notification = $this->Notification_model->get_pending_notification_details($order_by = 'DESC',$entCode,$userId);	
		
		if (count($Notification) >0) {
			foreach($Notification as $row)
				$pendingNotificationDetails[] = array(
					'notificationId'=>$row['id'],
					'notificationType'=>$row['notification_type'],
					'displayMessage'=>$row['display_message'],
					'entCode' => $row['ent_code'],
					'createdBy' =>$row['created_by'],
					'recievedBy' => $row['recieved_by'],
					'readStatus'=>$row['read_status'],
					'transactionNumber'=>$row['transaction_number']
				);
		
		$all_stock_data[] = array(
				'pendingNotificationDetails' => $pendingNotificationDetails,
				'viewAllOrderNotification' => 'viewAllOrderNotification',
				'viewAllBillNotification' => 'viewAllBillNotification',
				'getEachOrderDetails' => 'getEachOrderDetails',
				'getEachBillDetails' => 'getEachBillDetails',
		);
		
		print_r(json_encode($all_stock_data));
		
		
	}
	}
	
	
	
	public function viewAllOrderNotification() { //working as expected. 
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$Notification = $this->Notification_model->get_order_notification_details($order_by = 'DESC',$entCode,$userId);	
		
		if (count($Notification) >0) {
			foreach($Notification as $row)
				$orderNotificationDetails[] = array(
					'notificationId'=>$row['id'],
					'notificationType'=>$row['notification_type'],
					'displayMessage'=>$row['display_message'],
					'entCode' => $row['ent_code'],
					'createdBy' =>$row['created_by'],
					'recievedBy' => $row['recieved_by'],
					'readStatus'=>$row['read_status'],
					'transactionNumber'=>$row['transaction_number']
				);
		
		$all_stock_data[] = array(
				'orderNotificationDetails' => $orderNotificationDetails,
				'getEachOrderDetails' => 'getEachOrderDetails',
				'viewPendingNotificationDetails'=>'viewPendingNotificationDetails'
		);
		
		print_r(json_encode($all_stock_data));
		
		
	}
	}
	
	public function viewAllBillNotification() { //working as expected. 
		$entCode = $this->input->post('entCode');
		$userId = $this->input->post('userId');
		$Notification = $this->Notification_model->get_bill_notification_details($order_by = 'DESC',$entCode,$userId);	
		
		if (count($Notification) >0) {
			foreach($Notification as $row)
				$billNotificationDetails[] = array(
					'notificationId'=>$row['id'],
					'notificationType'=>$row['notification_type'],
					'displayMessage'=>$row['display_message'],
					'entCode' => $row['ent_code'],
					'createdBy' =>$row['created_by'],
					'recievedBy' => $row['recieved_by'],
					'readStatus'=>$row['read_status'],
					'transactionNumber'=>$row['transaction_number']
				);
		
		$all_stock_data[] = array(
				'billNotificationDetails' => $billNotificationDetails,
				'getEachBillDetails' => 'getEachBillDetails',
				'viewPendingNotificationDetails'=>'viewPendingNotificationDetails'
		);
		
		print_r(json_encode($all_stock_data));
		
		
	}
	}
	
		
	
}
