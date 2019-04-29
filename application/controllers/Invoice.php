<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Product_model');
		$this->load->library('encrypt');	
		
	}
	
	public function index()
	{
		$data['title'] = "HealthCare - Invoice Details";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Invoice/invoice');
		$this->load->view('Home/footer');
		
	}
	
	public function createinvoice()
	{
		$data['auto_code'] = $this->Invoice_model->get_invoicecode($_SESSION['ID']);
	    $data['lineinvoice'] = $this->Invoice_model->view_record('DESC');
		$id = $_SESSION['ID'];
		$data['Mainsubtotal'] = $this->Invoice_model->get_total_amount($id);
		$data['Maintaxpercent'] = $this->Invoice_model->get_total_tax_percent($id);
		$data['MaintaxAmt'] = $this->Invoice_model->get_total_tax_amt($id);
		$data['MainAmt'] = $this->Invoice_model->get_total_amt($id);
		$data['prodcount'] = $this->Invoice_model->products_count($id) ;
		
		
		$this->form_validation->set_rules('productname','Product Name','required');
		$this->form_validation->set_rules('qty','Quantity','required|numeric|is_natural_no_zero');
		
		
			
			
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "HealthCare - New Invoice";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Invoice/invoice',$data);
		$this->load->view('Home/footer');
		}
		else
		{
		$uom = $this->input->post('cbo_uom');
		$batch = $this->input->post('batchno');
		$prodtype = $this->input->post('prodtype');
		$data =array
			(
				'product_id'=>$this->input->post('productid'),
				'product_code'=>$this->input->post('productcode'),
				'product_name'=>$this->input->post('productname'),
				'product_type'=>$prodtype,
				'batchno'=>$batch,
				'stock'=>$this->input->post('stock'),
				'sale_rate'=>$this->input->post('salerate'),
				'tax_percent'=>$this->input->post('tax'),
				'product_uom'=>$uom,
				'product_qty'=>$this->input->post('qty'),
				'sub_total'=>$this->input->post('lineamount'),
				'tax_amount'=>$this->input->post('linetaxamt'),
				'total'=> round($this->input->post('linetaxamt') + $this->input->post('lineamount')),
				'user_id'=>$_SESSION['ID']
			);			
			
			$this->Invoice_model->add_record($data);
			if($uom == 'Boxes'){
				
				if($prodtype == "Tablet"){
					$upqty = (int)$this->input->post('qty') * (int)$this->input->post('stripsinbox') * (int)$this->input->post('pcsinstrip');
					$stock = (int)$this->input->post('stockinpcs') - (int)$upqty;
					//print_r($stock);
					$data = array(
						'product_qty'=>$stock,
					);
					$this->Product_model->update_stock($data,$batch);
				}elseif($prodtype == "Liquid"){
					$upqty = (int)$this->input->post('qty') * (int)$this->input->post('bottlesinbox') * (int)$this->input->post('mlinbottle');
					$stock = (int)$this->input->post('stockinpcs') - (int)$upqty;
					print_r($this->input->post('qty'));
					$data = array(
						'product_qty'=>$stock,
					);
					$this->Product_model->update_stock($data,$batch);
					}
			
			
				}else if($uom == 'Strips'){
				$upqty = (int)$this->input->post('qty') * (int)$this->input->post('pcsinstrip');
				$stock = (int)$this->input->post('stockinpcs') - (int)$upqty;
				//print_r($stock);
				$data = array(
					'product_qty'=>$stock,
				);
				$this->Product_model->update_stock($data,$batch);
				}else if($uom == 'Pcs'){
				$upqty = (int)$this->input->post('qty');
				$stock = (int)$this->input->post('stockinpcs') - (int)$upqty;
				//print_r($stock);
				$data = array(
					'product_qty'=>$stock,
				);
				$this->Product_model->update_stock($data,$batch);
				}else if($uom == 'Bottles'){
				$upqty = (int)$this->input->post('qty') * (int)$this->input->post('mlinbottle');
				$stock = (int)$this->input->post('stockinpcs') - (int)$upqty;
				print_r($this->input->post('qty'));
				$data = array(
					'product_qty'=>$stock,
				);
				$this->Product_model->update_stock($data,$batch);
				}else if($uom == 'Ml'){
				$upqty = (int)$this->input->post('qty');
				print_r($upqty);
				$stock = (int)$this->input->post('stockinpcs')- (int)$upqty;
				print_r($this->input->post('qty'));
				$data = array(
					'product_qty'=>$stock,
				);
				$this->Product_model->update_stock($data,$batch);
				}
				
				redirect(base_url().'Invoice/createinvoice');  
			
		
		}
	}
	
	
		public function saveinvoice()
		{
		
		
	    $data['lineinvoice'] = $this->Invoice_model->view_record('DESC');
		$id = $_SESSION['ID'];
		$data['Mainsubtotal'] = $this->Invoice_model->get_total_amount($id);
		$data['Maintaxpercent'] = $this->Invoice_model->get_total_tax_percent($id);
		$data['MaintaxAmt'] = $this->Invoice_model->get_total_tax_amt($id);
		$data['MainAmt'] = $this->Invoice_model->get_total_amt($id);
		$data['prodcount'] = $this->Invoice_model->products_count($id) ;
		
	    // Field Validation
		$this->form_validation->set_rules('patientname','Patient Name','required');
		$this->form_validation->set_rules('cbo_gender','Patient Gender','required');
		$this->form_validation->set_rules('patientphoneno','Patient PhoneNo','required|numeric');
		$this->form_validation->set_rules('prodcount', 'Prodcount', 'callback_prodcount_check');
		$this->form_validation->set_rules('fees','Fees','required|numeric|is_natural_no_zero');
		$this->form_validation->set_rules('age','Age','required|numeric|is_natural_no_zero');
		
		if(($this->form_validation->run())==false)
		{
		$data['title'] = "HealthCare - New Invoice";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Invoice/invoice',$data);
		$this->load->view('Home/footer');
		}
		else
		{
		$datestring = date('Y-m-d');
		$data =array
			(
				'user_id'=>$_SESSION['ID'],
				'patient_name'=>$this->input->post('patientname'),
				'patient_gender'=>$this->input->post('cbo_gender'),
				'patient_phoneno'=>$this->input->post('patientphoneno'),
				'age'=>$this->input->post('age'),
				'patient_address'=>$this->input->post('address'),
				'status'=>1
				
			);			
			$this->Invoice_model->add_patient_record($data);
			
			$patientMaxId = $this->Invoice_model->get_patient_max_id();
			$data['auto_code'] = $this->Invoice_model->get_invoicecode($_SESSION['ID']);
			$invoicenum = (int)$data['auto_code']['continues_count'];
			$data =array
			(
				'user_id'=>$_SESSION['ID'],
				'invoice_amt'=>$this->input->post('totalamt'),
				'total_tax_amt'=>$this->input->post('totaltaxamt'),
				'created_date'=>$datestring,
				'fees'=>$this->input->post('fees'),
				'total_gross_amt'=>$this->input->post('totalgrossamt'),
				'invoice_no'=>$data['auto_code']['series_id'].''.$data['auto_code']['user_id'].'-'.$data['auto_code']['continues_count'],
				'patient_id'=>$patientMaxId
				
			);	
			$this->Invoice_model->add_invoice_main_record($data);
			
			$data['lineinvoice'] = $this->Invoice_model->view_record('DESC');
			$linecount = count($data['lineinvoice']);
			for($i=0; $i < $linecount ; $i++){
				$data['lineinvoice'] = $this->Invoice_model->view_record('DESC');
				$data =array
				(
					'product_id'=>$data['lineinvoice'][$i]['product_id'],
					'product_code'=>$data['lineinvoice'][$i]['product_code'],
					'product_name'=>$data['lineinvoice'][$i]['product_name'],
					'product_type'=>$data['lineinvoice'][$i]['product_type'],
					'batchno'=>$data['lineinvoice'][$i]['batchno'],
					'stock'=>$data['lineinvoice'][$i]['stock'],
					'sale_rate'=>$data['lineinvoice'][$i]['sale_rate'],
					'tax_percent'=>$data['lineinvoice'][$i]['tax_percent'],
					'product_uom'=>$data['lineinvoice'][$i]['product_uom'],
					'product_qty'=>$data['lineinvoice'][$i]['product_qty'],
					'sub_total'=>$data['lineinvoice'][$i]['sub_total'],
					'tax_amount'=>$data['lineinvoice'][$i]['tax_amount'],
					'total'=> $data['lineinvoice'][$i]['total'],
					'user_id'=>$data['lineinvoice'][$i]['user_id']
				);			
				$this->Invoice_model->add_invoice_record($data);
			}
			
			
			
			$datestring = date('Y-m-d');			
			$data =array
			(
				'last_updated'=>mdate($datestring),
				'continues_count'=> $invoicenum + 1
				
			);
			//print_r($data);
			$this->Invoice_model->incriment_invoice_no($data,$_SESSION['ENT_ID']);
			
			$this->Invoice_model->delete_all_record($_SESSION['ID']);
			
			$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    
                    <i class="icon fa fa-check"></i> Record Added Successfully.
                  </div>
				  ');
			
			redirect(base_url().'Invoice/invoicelist'); 
			
			
		}
	}
	
	
	
	
	
	public function auto_search()
	{
		//$id = $_SESSION['ID'];
		if(isset($_GET['term'])) 
		{
		 $proddetails = $this->Invoice_model->auto_featch($_GET['term'], $_SESSION['ID']);
		
		if(count($proddetails) >0){
		foreach($proddetails as $row)
		
		$result_array[] = array('label' => $row->product_name,
								'product_type' => $row->product_type,
								'id' => $row->id,
								'prodcode' => $row->product_code,
								'batchno' => $row->batchno,
								'stock' => $row->product_qty,
								'price' => $row->salerate,
								'tax' => $row->tax_percent,
								'stripsinbox' =>$row->stripsinbox,
								'bottlesinbox' => $row->bottlesinbox,
								'mlinbottle' => $row->mlinbottle,
								'pcsinstrip' =>$row->pcsinstrip,
								'stockinbox' =>(int)((int)$row->product_qty /((int)$row->stripsinbox * (int)$row->pcsinstrip)),
								'stockinstrips' =>(int)((int)$row->product_qty /(int)$row->pcsinstrip),
								'botstockinbox' =>(int)((int)$row->product_qty /((int)$row->bottlesinbox * (int)$row->mlinbottle)),
								'stockinbottle' =>(int)((int)$row->product_qty /(int)$row->mlinbottle),
		);
		
		echo json_encode($result_array);
		}
		
			
		}
		
	}
	
	
	
	
	public function delete_record($id=0)
	{
		$id = $this->uri->segment(3);
		
		if ($id==0)
		{
			$this->index();			
		}	
		
		$tempproddetails = $this->Product_model->get_temp_record_by_id($id);
		//print_r($tempproddetails );
		$uom = $tempproddetails['product_uom'];
		$batch = $tempproddetails['batchno'];
		$proddetails = $this->Product_model->get_record_by_batch($batch);
		
		$this->Invoice_model->delete_record($id);
		
		if($uom === 'Boxes'){
			
			
			
			if($proddetails['product_type'] == "Tablet"){
			$upqty = (int)$tempproddetails['product_qty'] * (int)$proddetails['stripsinbox'] * (int)$proddetails['pcsinstrip'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			print_r($tempproddetails['product_qty']);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}else if($proddetails['product_type'] == "Liquid"){
				
			$upqty = (int)$tempproddetails['product_qty'] * (int)$proddetails['bottlesinbox'] * (int)$proddetails['mlinbottle'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			print_r($tempproddetails['product_qty']);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}
			
			}else if($uom === 'Strips'){
			$upqty = (int)$tempproddetails['product_qty'] *  (int)$proddetails['pcsinstrip'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			
			//print_r($stock);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}else if($uom === 'Pcs'){
			$upqty = (int)$tempproddetails['product_qty'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			//print_r($stock);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}else if($uom === 'Bottles'){
			
			$upqty = (int)$tempproddetails['product_qty'] * (int)$proddetails['mlinbottle'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			print_r($tempproddetails['product_qty']);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}else if($uom === 'Ml'){
			
			$upqty = (int)$tempproddetails['product_qty'];
			$stock = (int)$proddetails['product_qty'] + (int)$upqty;
			print_r($tempproddetails['product_qty']);
			$data = array(
				'product_qty'=>$stock,
			);
			$this->Product_model->update_stock($data,$batch);
			}
			
		redirect(base_url().'Invoice/createinvoice'); 
	}
	
	public function prodcount_check($str)
        {
                if ($str == '0')
                {
                        $this->form_validation->set_message('prodcount_check', 'Add atleast one product to list');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
	
	
	public function invoicelist()
	{
		if(strtoupper($_SESSION['USER_TYPE']) == 'ADMIN'){	
		$data['invoice'] = $this->Invoice_model->view_invoice_details_admin('DESC');
		}else{
		$data['invoice'] = $this->Invoice_model->view_invoice_details('DESC');
		}
		$data['title'] = "Invoice Details";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Invoice/invoicelist');
		$this->load->view('Home/footer');
	}
	
	public function invoiceview()
	{
		$id = $this->uri->segment(3);
		$userId = $_SESSION['ID'];
		if ($id==0)
		{
			$this->index();			
		}	
		
		$data['invoice_header'] = $this->Invoice_model->get_invoice_header_details_to_view($id,$userId);
		$data['invoice_body'] = $this->Invoice_model->get_invoice_product_details_to_view($id,$userId);
		
		$data['title'] = "Invoice view";
		$this->load->view('Home/header',$data);
		$this->load->view('Home/menu');
		$this->load->view('Invoice/invoiceview',$data);
		$this->load->view('Home/footer'); 
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
