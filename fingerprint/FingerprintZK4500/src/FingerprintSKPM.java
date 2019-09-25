import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.util.ArrayList;
import java.util.List;

import javax.imageio.ImageIO;
import javax.swing.ButtonGroup;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JRadioButton;
import javax.swing.JTextArea;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.zkteco.biometric.FingerprintSensorErrorCode;
import com.zkteco.biometric.FingerprintSensorEx;

public class FingerprintSKPM extends JFrame{
	public FingerprintSKPM() {
	}
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	
//	JButton btnOpen = null;
//	JButton btnEnroll = null;
//	JButton btnVerify = null;
//	JButton btnIdentify = null;
	JButton btnRegImg = null;
	JButton btnIdentImg = null;
//	JButton btnClose = null;
	JButton btnImg = null;
	JRadioButton radioISO = null;
	JRadioButton radioANSI = null;
	JRadioButton radioZK = null;
	
	
	private JTextArea textArea;
	
	private JTextArea textArea2;
	
	
	//the width of fingerprint image
	int fpWidth = 0;
	//the height of fingerprint image
	int fpHeight = 0;
	//for verify test
	private byte[] lastRegTemp = new byte[2048]; //array??
	//the length of lastRegTemp
	private int cbRegTemp = 0;
	//pre-register template
	private byte[][] regtemparray = new byte[3][2048]; //array[3]??
	//Register
	private boolean bRegister = false;
	//Identify
	private boolean bIdentify = true;
	//finger id
	private int iFid = 1;
	
	private int nFakeFunOn = 1;
	//must be 3
	static final int enroll_cnt = 3;
	//the index of pre-register function
	private int enroll_idx = 0;
	
	private byte[] imgbuf = null;
	private byte[] template = new byte[2048];
	private int[] templateLen = new int[1];
	
	
	private boolean mbStop = true;
	private long mhDevice = 0;
	private long mhDB = 0;
	private WorkThread workThread = null;
	
	/**
	 * 
	 */
	private Thread closeThread8077;
	private Thread closeThread8073;
	private Thread threadSendMemberID;
	private Thread threadOpenRegister;
	private Thread threadRetrieveData;
	private Thread threadSend8073;
	private Thread threadSend8078;
	private String str1;

	public void runThread(){
			

		closeThread8073 = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
				byte[] varBuffer = new byte[7];
				InetAddress varAdd = InetAddress.getByName("127.0.0.1");
				String str1 = "cancel1";
				varBuffer = str1.getBytes();
				
				DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
				
				DatagramSocket ds = new DatagramSocket();
				ds.send(dp);
				
				System.out.println("Data sent!");
				ds.close();
				}catch (Exception e){
					e.printStackTrace();
				}
			}
		});

		threadSendMemberID = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
					byte[] arrBuffer = new byte[10000];
					
					DatagramPacket dp = new DatagramPacket(arrBuffer,arrBuffer.length);

					while(true){
						DatagramSocket ds = new DatagramSocket(8080);
						System.out.println("Standing by receiving data...");

						ds.receive(dp);
						arrBuffer = null;
						arrBuffer = dp.getData();
						
						String str = new String(arrBuffer);
						textArea2.setText(str);
						System.out.print(textArea2.getText());
						ds.close();
					}
		
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});

		threadOpenRegister = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
					byte[] arrBuffer = new byte[8];
					DatagramPacket dp = new DatagramPacket(arrBuffer,arrBuffer.length);
					while(true){
						DatagramSocket ds = new DatagramSocket(8077);
						System.out.println("Standing by receiving data...");
						ds.receive(dp);
						arrBuffer = null;
						arrBuffer = dp.getData();
						String str = new String(arrBuffer);
						bRegister = true;
						System.out.println(bRegister);
						System.out.print(str);
						ds.close();

					}
		
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});

		threadRetrieveData = new Thread(new Runnable(){
			@Override
			public void run(){		//test retrieve data from database
				List<NameValuePair> params = new ArrayList<NameValuePair>();
				params.add(new BasicNameValuePair("selectAll","all"));
				params.add(new BasicNameValuePair("member","member"));

				String strUrl = "http://localhost/SKPM/fingerprint/SelectAll.php";
				JSONArray jsnArr = makeHTTPRequest(strUrl,"POST",params);
				JSONObject jsnObj = new JSONObject();
				StringBuilder sb = new StringBuilder();
				try{
					for(int i = 0 ; i < jsnArr.length() ; i++){
						jsnObj = jsnArr.optJSONObject(i);
						int id1 = jsnObj.getInt("member_id");
						String num_ic= jsnObj.getString("member_ic");
						String fing_reg= jsnObj.getString("member_finger");
						double num_ic1 = Double.valueOf(num_ic);
						int num_ic2 = (int)Math.round(num_ic1);
						String id = Integer.toString(id1);

						byte [] buf = new byte[2048];
						int check = FingerprintSensorEx.Base64ToBlob(fing_reg,buf,2048);
						iFid = id1;
						int ret = FingerprintSensorEx.DBAdd(mhDB,iFid,buf);
						System.out.println(ret);
					}
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});

		threadSend8073 = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
				byte[] varBuffer = new byte[7];
				InetAddress varAdd = InetAddress.getByName("127.0.0.1");
				varBuffer = str1.getBytes();
				DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
				DatagramSocket ds = new DatagramSocket();
				ds.send(dp);
				System.out.println("Data sent!");
				ds.close();
				}catch (Exception e){
					e.printStackTrace();
				}
			}
		});

		threadSend8078 = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
				byte[] varBuffer = new byte[100];
				InetAddress varAdd = InetAddress.getByName("127.0.0.1");
				
				varBuffer = str1.getBytes();
				
				DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8078);
				
				DatagramSocket ds = new DatagramSocket();
				ds.send(dp);
				
				System.out.println("Data sent!");
				ds.close();
				}catch (Exception e){
					e.printStackTrace();
				}
			}
		});
	}
	public void launchDesign(){
		getContentPane().setLayout (null);
//		btnOpen = new JButton("Open");  
//		getContentPane().add(btnOpen);  
		int nRsize = 20;
//		btnOpen.setBounds(30, 10 + nRsize, 140, 30);
		
//		btnEnroll = new JButton("Enroll");  
//		getContentPane().add(btnEnroll);  
//		btnEnroll.setBounds(30, 60 + nRsize, 140, 30);
		
//		btnVerify = new JButton("Verify");  
//		getContentPane().add(btnVerify);  
//		btnVerify.setBounds(30, 110 + nRsize, 140, 30);
		
//		btnIdentify = new JButton("Identify");  
//		getContentPane().add(btnIdentify);  
//		btnIdentify.setBounds(30, 160 + nRsize, 140, 30);
		
//		btnRegImg = new JButton("Register By Image");  
//		getContentPane().add(btnRegImg);  
//		btnRegImg.setBounds(30, 210 + nRsize, 140, 30);
		
//		btnIdentImg = new JButton("Verify By Image");  
//		getContentPane().add(btnIdentImg);  
//		btnIdentImg.setBounds(30, 260 + nRsize, 140, 30);
		
		
//			 = new JButton("Close");  
//		getContentPane().add(btnClose);  
//		btnClose.setBounds(30, 310 + nRsize, 140, 30);
		
		
		//For ISO/Ansi/ZK
		radioANSI = new JRadioButton("ANSI", true);
		getContentPane().add(radioANSI);  
		radioANSI.setBounds(30, 360 + nRsize, 60, 30);
		
		radioISO = new JRadioButton("ISO");
		getContentPane().add(radioISO);  
		radioISO.setBounds(120, 360 + nRsize, 60, 30);
		
		radioZK = new JRadioButton("ZK");
		getContentPane().add(radioZK);
		radioZK.setBounds(210, 360 + nRsize, 60, 30);
        
        ButtonGroup group = new ButtonGroup();
        group = new ButtonGroup();
        group.add(radioANSI);
        group.add(radioISO);
        group.add(radioZK);
        //For End
        
		btnImg = new JButton();
		btnImg.setBounds(200, 5, 288, 375);
		btnImg.setDefaultCapable(false);
		getContentPane().add(btnImg); 
		
		textArea = new JTextArea();
		getContentPane().add(textArea);  
		textArea.setBounds(10, 420, 490, 150);
		textArea.setLineWrap(true);
		textArea.setSelectedTextColor(Color.RED);
		
		textArea2 = new JTextArea(1,12);
		getContentPane().add(textArea2);  
		textArea2.setBounds(50, 10, 100, 20);
		textArea2.setLineWrap(true);
		textArea2.setSelectedTextColor(Color.RED);
		textArea2.setEditable(false);
		
	}
	public void openLoad(){
		if (0 != mhDevice)
		{
			//already inited
			textArea.setText("Please close device first!\n");
			return;
		}
		int ret = FingerprintSensorErrorCode.ZKFP_ERR_OK;
		//Initialize
		cbRegTemp = 0;
		bRegister = false;
		bIdentify = true;
		iFid = 1;
		enroll_idx = 0;
		if (FingerprintSensorErrorCode.ZKFP_ERR_OK != FingerprintSensorEx.Init())
		{
			textArea.setText("Init failed!\n");
			return;
		}
		ret = FingerprintSensorEx.GetDeviceCount();
		if (ret < 0)
		{
			textArea.setText("No devices connected!\n");
			FreeSensor(); //Fingerprint store in FreeSensor?
			return;
		}
		if (0 == (mhDevice = FingerprintSensorEx.OpenDevice(0)))
		{
			textArea.setText("Open device fail, ret = " + ret + "!\n");
			FreeSensor();
			return;
		}
		if (0 == (mhDB = FingerprintSensorEx.DBInit()))
		{
			textArea.setText("Init DB fail, ret = " + ret + "!\n");
			FreeSensor();
			return;
		}
		
		//For ISO/Ansi
		int nFmt = 0;	//Ansi
		if (radioISO.isSelected())
		{
			nFmt = 1;	//ISO
		}
		FingerprintSensorEx.DBSetParameter(mhDB,  5010, nFmt);				
		//For ISO/Ansi End
		
		//set fakefun off
		//FingerprintSensorEx.SetParameter(mhDevice, 2002, changeByte(nFakeFunOn), 4);
		
		byte[] paramValue = new byte[4];
		int[] size = new int[1];
		//GetFakeOn
		//size[0] = 4;
		//FingerprintSensorEx.GetParameters(mhDevice, 2002, paramValue, size);
		//nFakeFunOn = byteArrayToInt(paramValue);
		
		size[0] = 4;
		FingerprintSensorEx.GetParameters(mhDevice, 1, paramValue, size);
		fpWidth = byteArrayToInt(paramValue);
		size[0] = 4;
		FingerprintSensorEx.GetParameters(mhDevice, 2, paramValue, size);
		fpHeight = byteArrayToInt(paramValue);
						
		imgbuf = new byte[fpWidth*fpHeight];
		//btnImg.resize(fpWidth, fpHeight);
		mbStop = false;
		workThread = new WorkThread();
	    workThread.start();// 线程启动
	    threadRetrieveData = new Thread(new Runnable(){
			@Override
			public void run(){		//test retrieve data from database
				List<NameValuePair> params = new ArrayList<NameValuePair>();
				params.add(new BasicNameValuePair("selectAll","all"));
				params.add(new BasicNameValuePair("member","member"));

				String strUrl = "http://localhost/SKPM/fingerprint/SelectAll.php";
				JSONArray jsnArr = makeHTTPRequest(strUrl,"POST",params);
				JSONObject jsnObj = new JSONObject();
				StringBuilder sb = new StringBuilder();
				try{
					for(int i = 0 ; i < jsnArr.length() ; i++){
						jsnObj = jsnArr.optJSONObject(i);
						int id1 = jsnObj.getInt("member_id");
						String num_ic= jsnObj.getString("member_ic");
						String fing_reg= jsnObj.getString("member_finger");
						double num_ic1 = Double.valueOf(num_ic);
						int num_ic2 = (int)Math.round(num_ic1);
						String id = Integer.toString(id1);

						byte [] buf = new byte[2048];
						int check = FingerprintSensorEx.Base64ToBlob(fing_reg,buf,2048);
						iFid = id1;
						int ret = FingerprintSensorEx.DBAdd(mhDB,iFid,buf);
						System.out.println(ret);
					}
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});
	    threadRetrieveData.start();
		textArea.setText("Open succ! Finger Image Width:" + fpWidth + ",Height:" + fpHeight +"\n");
	}
	public void launchFrame(){
		launchDesign();
		// runThread();
		//Close 8077 thread10
		closeThread8077 = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
				byte[] varBuffer = new byte[7];
				InetAddress varAdd = InetAddress.getByName("127.0.0.1");
				String str1 = "cancel1";
				varBuffer = str1.getBytes();
				
				DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8077);
				
				DatagramSocket ds = new DatagramSocket();
				ds.send(dp);
				
				System.out.println("Data sent!");
				ds.close();
				}catch (Exception e){
					e.printStackTrace();
				}
			}
		});
		closeThread8077.start();

		//Close 8073 thread11
		closeThread8073 = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
				byte[] varBuffer = new byte[7];
				InetAddress varAdd = InetAddress.getByName("127.0.0.1");
				String str1 = "cancel1";
				varBuffer = str1.getBytes();
				
				DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
				
				DatagramSocket ds = new DatagramSocket();
				ds.send(dp);
				
				System.out.println("Data sent!");
				ds.close();
				}catch (Exception e){
					e.printStackTrace();
				}
			}
		});
		closeThread8073.start();

		//Sending Member ID thread2
		threadSendMemberID = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
					byte[] arrBuffer = new byte[10000];
					
					DatagramPacket dp = new DatagramPacket(arrBuffer,arrBuffer.length);

					while(true){
						DatagramSocket ds = new DatagramSocket(8080);
						System.out.println("Standing by receiving data...");

						ds.receive(dp);
						arrBuffer = null;
						arrBuffer = dp.getData();
						
						String str = new String(arrBuffer);
						textArea2.setText(str);
						System.out.print(textArea2.getText());
						ds.close();
					}
		
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});
		threadSendMemberID.start();
		
		//Open Register thread5
		threadOpenRegister = new Thread(new Runnable(){
			@Override
			public void run(){
				try{
					byte[] arrBuffer = new byte[8];
					DatagramPacket dp = new DatagramPacket(arrBuffer,arrBuffer.length);
					while(true){
						DatagramSocket ds = new DatagramSocket(8077);
						System.out.println("Standing by receiving data...");
						ds.receive(dp);
						arrBuffer = null;
						arrBuffer = dp.getData();
						String str = new String(arrBuffer);
						bRegister = true;
						System.out.println(bRegister);
						System.out.print(str);
						ds.close();

					}
		
				}catch(Exception e){
					e.printStackTrace();
				}
			}
		});
		threadOpenRegister.start();

		this.setSize(520, 620);
		this.setLocationRelativeTo(null);
		this.setVisible(true);
		this.setTitle("ZKFingerSKPM");
		this.setResizable(false);
		
		//Retreive Data thread3
		
//		btnOpen.addActionListener(new ActionListener() {
//
//			@Override
//			public void actionPerformed(ActionEvent e) {
//				// TODO Auto-generated method stub
//				if (0 != mhDevice)
//				{
//					//already inited
//					textArea.setText("Please close device first!\n");
//					return;
//				}
//				int ret = FingerprintSensorErrorCode.ZKFP_ERR_OK;
//				//Initialize
//				cbRegTemp = 0;
//				bRegister = false;
//				bIdentify = false;
//				iFid = 1;
//				enroll_idx = 0;
//				if (FingerprintSensorErrorCode.ZKFP_ERR_OK != FingerprintSensorEx.Init())
//				{
//					textArea.setText("Init failed!\n");
//					return;
//				}
//				ret = FingerprintSensorEx.GetDeviceCount();
//				if (ret < 0)
//				{
//					textArea.setText("No devices connected!\n");
//					FreeSensor(); //Fingerprint store in FreeSensor?
//					return;
//				}
//				if (0 == (mhDevice = FingerprintSensorEx.OpenDevice(0)))
//				{
//					textArea.setText("Open device fail, ret = " + ret + "!\n");
//					FreeSensor();
//					return;
//				}
//				if (0 == (mhDB = FingerprintSensorEx.DBInit()))
//				{
//					textArea.setText("Init DB fail, ret = " + ret + "!\n");
//					FreeSensor();
//					return;
//				}
//				
//				//For ISO/Ansi
//				int nFmt = 0;	//Ansi
//				if (radioISO.isSelected())
//				{
//					nFmt = 1;	//ISO
//				}
//				FingerprintSensorEx.DBSetParameter(mhDB,  5010, nFmt);				
//				//For ISO/Ansi End
//				
//				//set fakefun off
//				//FingerprintSensorEx.SetParameter(mhDevice, 2002, changeByte(nFakeFunOn), 4);
//				
//				byte[] paramValue = new byte[4];
//				int[] size = new int[1];
//				//GetFakeOn
//				//size[0] = 4;
//				//FingerprintSensorEx.GetParameters(mhDevice, 2002, paramValue, size);
//				//nFakeFunOn = byteArrayToInt(paramValue);
//				
//				size[0] = 4;
//				FingerprintSensorEx.GetParameters(mhDevice, 1, paramValue, size);
//				fpWidth = byteArrayToInt(paramValue);
//				size[0] = 4;
//				FingerprintSensorEx.GetParameters(mhDevice, 2, paramValue, size);
//				fpHeight = byteArrayToInt(paramValue);
//								
//				imgbuf = new byte[fpWidth*fpHeight];
//				//btnImg.resize(fpWidth, fpHeight);
//				mbStop = false;
//				workThread = new WorkThread();
//			    workThread.start();// 线程启动
//			    threadRetrieveData = new Thread(new Runnable(){
//					@Override
//					public void run(){		//test retrieve data from database
//						List<NameValuePair> params = new ArrayList<NameValuePair>();
//						params.add(new BasicNameValuePair("selectAll","all"));
//						params.add(new BasicNameValuePair("member","member"));
//
//						String strUrl = "http://localhost/SKPM/fingerprint/SelectAll.php";
//						JSONArray jsnArr = makeHTTPRequest(strUrl,"POST",params);
//						JSONObject jsnObj = new JSONObject();
//						StringBuilder sb = new StringBuilder();
//						try{
//							for(int i = 0 ; i < jsnArr.length() ; i++){
//								jsnObj = jsnArr.optJSONObject(i);
//								int id1 = jsnObj.getInt("member_id");
//								String num_ic= jsnObj.getString("member_ic");
//								String fing_reg= jsnObj.getString("member_finger");
//								double num_ic1 = Double.valueOf(num_ic);
//								int num_ic2 = (int)Math.round(num_ic1);
//								String id = Integer.toString(id1);
//
//								byte [] buf = new byte[2048];
//								int check = FingerprintSensorEx.Base64ToBlob(fing_reg,buf,2048);
//								iFid = id1;
//								int ret = FingerprintSensorEx.DBAdd(mhDB,iFid,buf);
//								System.out.println(ret);
//							}
//						}catch(Exception e){
//							e.printStackTrace();
//						}
//					}
//				});
//				threadRetrieveData.start();
//				textArea.setText("Open succ! Finger Image Width:" + fpWidth + ",Height:" + fpHeight +"\n");
//			}
//		});
		
		
		
//		btnClose.addActionListener(new ActionListener() {
//
//			@Override
//			public void actionPerformed(ActionEvent e) {
//				// TODO Auto-generated method stub
//				FreeSensor();
//				
//				textArea.setText("Close succ!\n");
//			}
//		});
		
//		btnEnroll.addActionListener(new ActionListener() {
//
//			@Override
//			public void actionPerformed(ActionEvent e) {
//				if(0 == mhDevice)
//				{
//					textArea.setText("Please Open device first!\n");
//					return;
//				}
//				if(!bRegister)
//				{
//					enroll_idx = 0;
//					bRegister = true;
//					textArea.setText("Please your finger 3 times!\n");
//				}
//			}
//			});
		
//		btnVerify.addActionListener(new ActionListener() {
//
//			@Override
//			public void actionPerformed(ActionEvent e) {
//				if(0 == mhDevice)
//				{
//					textArea.setText("Please Open device first!\n");
//					return;
//				}
//				if(bRegister)
//				{
//					enroll_idx = 0;
//					bRegister = false;
//				}
//				if(bIdentify)
//				{
//					bIdentify = false;
//				}
//			}
//			});
		
//		btnIdentify.addActionListener(new ActionListener() {
//
//			@Override
//			public void actionPerformed(ActionEvent e) {
//				if(0 == mhDevice)
//				{
//					textArea.setText("Please Open device first!\n");
//					return;
//				}
//				if(bRegister)
//				{
//					enroll_idx = 0;
//					bRegister = false;
//				}
//				if(!bIdentify)
//				{
//					bIdentify = true;
//				}
//			}
//			});
		
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.addWindowListener(new WindowAdapter(){

            @Override
            public void windowClosing(WindowEvent e) {
                // TODO Auto-generated method stub
            	FreeSensor();
            }
		});
		
		openLoad();
		
	}
	
	private void FreeSensor()
	{
		mbStop = true;
		try {		//wait for thread stopping
			Thread.sleep(1000);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		if (0 != mhDB)
		{
			
			FingerprintSensorEx.DBFree(mhDB);
			mhDB = 0;
		}
		if (0 != mhDevice)
		{
			FingerprintSensorEx.CloseDevice(mhDevice);
			mhDevice = 0;
		}
		FingerprintSensorEx.Terminate();
	}
	
	public static void writeBitmap(byte[] imageBuf, int nWidth, int nHeight,
			String path) throws IOException {
		java.io.FileOutputStream fos = new java.io.FileOutputStream(path);
		java.io.DataOutputStream dos = new java.io.DataOutputStream(fos);

		int w = (((nWidth+3)/4)*4);
		int bfType = 0x424d; // 位图文件类型（0—1字节）
		int bfSize = 54 + 1024 + w * nHeight;// bmp文件的大小（2—5字节）
		int bfReserved1 = 0;// 位图文件保留字，必须为0（6-7字节）
		int bfReserved2 = 0;// 位图文件保留字，必须为0（8-9字节）
		int bfOffBits = 54 + 1024;// 文件头开始到位图实际数据之间的字节的偏移量（10-13字节）

		dos.writeShort(bfType); // 输入位图文件类型'BM'
		dos.write(changeByte(bfSize), 0, 4); // 输入位图文件大小
		dos.write(changeByte(bfReserved1), 0, 2);// 输入位图文件保留字
		dos.write(changeByte(bfReserved2), 0, 2);// 输入位图文件保留字
		dos.write(changeByte(bfOffBits), 0, 4);// 输入位图文件偏移量

		int biSize = 40;// 信息头所需的字节数（14-17字节）
		int biWidth = nWidth;// 位图的宽（18-21字节）
		int biHeight = nHeight;// 位图的高（22-25字节）
		int biPlanes = 1; // 目标设备的级别，必须是1（26-27字节）
		int biBitcount = 8;// 每个像素所需的位数（28-29字节），必须是1位（双色）、4位（16色）、8位（256色）或者24位（真彩色）之一。
		int biCompression = 0;// 位图压缩类型，必须是0（不压缩）（30-33字节）、1（BI_RLEB压缩类型）或2（BI_RLE4压缩类型）之一。
		int biSizeImage = w * nHeight;// 实际位图图像的大小，即整个实际绘制的图像大小（34-37字节）
		int biXPelsPerMeter = 0;// 位图水平分辨率，每米像素数（38-41字节）这个数是系统默认值
		int biYPelsPerMeter = 0;// 位图垂直分辨率，每米像素数（42-45字节）这个数是系统默认值
		int biClrUsed = 0;// 位图实际使用的颜色表中的颜色数（46-49字节），如果为0的话，说明全部使用了
		int biClrImportant = 0;// 位图显示过程中重要的颜色数(50-53字节)，如果为0的话，说明全部重要

		dos.write(changeByte(biSize), 0, 4);// 输入信息头数据的总字节数
		dos.write(changeByte(biWidth), 0, 4);// 输入位图的宽
		dos.write(changeByte(biHeight), 0, 4);// 输入位图的高
		dos.write(changeByte(biPlanes), 0, 2);// 输入位图的目标设备级别
		dos.write(changeByte(biBitcount), 0, 2);// 输入每个像素占据的字节数
		dos.write(changeByte(biCompression), 0, 4);// 输入位图的压缩类型
		dos.write(changeByte(biSizeImage), 0, 4);// 输入位图的实际大小
		dos.write(changeByte(biXPelsPerMeter), 0, 4);// 输入位图的水平分辨率
		dos.write(changeByte(biYPelsPerMeter), 0, 4);// 输入位图的垂直分辨率
		dos.write(changeByte(biClrUsed), 0, 4);// 输入位图使用的总颜色数
		dos.write(changeByte(biClrImportant), 0, 4);// 输入位图使用过程中重要的颜色数

		for (int i = 0; i < 256; i++) {
			dos.writeByte(i);
			dos.writeByte(i);
			dos.writeByte(i);
			dos.writeByte(0);
		}

		byte[] filter = null;
		if (w > nWidth)
		{
			filter = new byte[w-nWidth];
		}
		
		for(int i=0;i<nHeight;i++)
		{
			dos.write(imageBuf, (nHeight-1-i)*nWidth, nWidth);
			if (w > nWidth)
				dos.write(filter, 0, w-nWidth);
		}
		dos.flush();
		dos.close();
		fos.close();
	}

	public static byte[] changeByte(int data) {
		return intToByteArray(data);
	}
	
	public static byte[] intToByteArray (final int number) {
		byte[] abyte = new byte[4];  
	    // "&" 与（AND），对两个整型操作数中对应位执行布尔代数，两个位都为1时输出1，否则0。  
	    abyte[0] = (byte) (0xff & number);  
	    // ">>"右移位，若为正数则高位补0，若为负数则高位补1  
	    abyte[1] = (byte) ((0xff00 & number) >> 8);  
	    abyte[2] = (byte) ((0xff0000 & number) >> 16);  
	    abyte[3] = (byte) ((0xff000000 & number) >> 24);  
	    return abyte; 
	}	 
		 
		public static int byteArrayToInt(byte[] bytes) {
			int number = bytes[0] & 0xFF;  
		    // "|="按位或赋值。  
		    number |= ((bytes[1] << 8) & 0xFF00);  
		    number |= ((bytes[2] << 16) & 0xFF0000);  
		    number |= ((bytes[3] << 24) & 0xFF000000);  
		    return number;  
		 }
	
		private class WorkThread extends Thread {
	        @Override
	        public void run() {
	            super.run();
	            int ret = 0;
	            while (!mbStop) {
	            	templateLen[0] = 2048;
	            	if (0 == (ret = FingerprintSensorEx.AcquireFingerprint(mhDevice, imgbuf, template, templateLen)))
	            	{
	            		if (nFakeFunOn == 1)
                    	{
                    		byte[] paramValue = new byte[4];
            				int[] size = new int[1];
            				size[0] = 4;
            				int nFakeStatus = 0;
            				//GetFakeStatus
            				ret = FingerprintSensorEx.GetParameters(mhDevice, 2004, paramValue, size);
            				nFakeStatus = byteArrayToInt(paramValue);
            				System.out.println("ret = "+ ret +",nFakeStatus=" + nFakeStatus);
            				if (0 == ret && (byte)(nFakeStatus & 31) != 31)
            				{
            					textArea.setText("Is a fake finger?\n");
            					return;
            				}
                    	}
                    	OnCatpureOK(imgbuf);
                    	OnExtractOK(template, templateLen[0]);
	            	}
	                try {
	                    Thread.sleep(500);
	                } catch (InterruptedException e) {
	                    e.printStackTrace();
	                }

	            }
	        }
	    }
		
		private void OnCatpureOK(byte[] imgBuf)
		{
			try {
				writeBitmap(imgBuf, fpWidth, fpHeight, "fingerprint.bmp");
				btnImg.setIcon(new ImageIcon(ImageIO.read(new File("fingerprint.bmp"))));
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		
		private void OnExtractOK(byte[] template, int len)
		{
			if(bRegister)
			{
				int[] fid = new int[1];
				int[] score = new int [1];
                int ret = FingerprintSensorEx.DBIdentify(mhDB, template, fid, score);
                if (ret == 0)
                {
					str1 = "cancel1";
                    textArea.setText("the finger already enroll by " + fid[0] + ",cancel enroll\n");
					//send 8073 cancel1 thread9
					threadSend8073 = new Thread(new Runnable(){
						@Override
						public void run(){
							try{
							byte[] varBuffer = new byte[7];
							InetAddress varAdd = InetAddress.getByName("127.0.0.1");
							varBuffer = str1.getBytes();
							DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
							DatagramSocket ds = new DatagramSocket();
							ds.send(dp);
							System.out.println("Data sent!");
							ds.close();
							}catch (Exception e){
								e.printStackTrace();
							}
						}
					});
            		threadSend8073.start();
                    bRegister = false;
                    enroll_idx = 0;
                    return;
                }
                if (enroll_idx > 0 && FingerprintSensorEx.DBMatch(mhDB, regtemparray[enroll_idx-1], template) <= 0)
                {
                	textArea.setText("please press the same finger 3 times for the enrollment\n");
                    return;
                }
                System.arraycopy(template, 0, regtemparray[enroll_idx], 0, 2048);
                enroll_idx++;
                if (enroll_idx == 3) {
                	int[] _retLen = new int[1];
                    _retLen[0] = 2048;
                    byte[] regTemp = new byte[_retLen[0]];
                    
                    
                    String fid1 = textArea2.getText();
                    double fid2 = Double.valueOf(fid1);
				     int fid3 = (int)Math.round(fid2);
				     System.out.println(fid3);
                    if (0 == (ret = FingerprintSensorEx.DBMerge(mhDB, regtemparray[0], regtemparray[1], regtemparray[2], regTemp, _retLen)) &&
                    		0 == (ret = FingerprintSensorEx.DBAdd(mhDB, fid3, regTemp))) {
                    	
                    	String fingerTemp = FingerprintSensorEx.BlobToBase64(regTemp, 2048);
                    	System.out.println(fingerTemp);
                    	
                    	List<NameValuePair> params = new ArrayList<NameValuePair>();
                		params.add(new BasicNameValuePair("selectFn","searchData"));
                		params.add(new BasicNameValuePair("MemberID",String.valueOf(fid3)));
                		params.add(new BasicNameValuePair("MemberFinger", fingerTemp));
                		
                		String strUrl = "http://localhost/SKPM/fingerprint/RegisterFingerprint.php";
                		makeHTTPRequest1(strUrl,"POST",params);
                    	
                    	iFid++;
                    	cbRegTemp = _retLen[0];
                        System.arraycopy(regTemp, 0, lastRegTemp, 0, cbRegTemp);
                        //Base64 Template
                        textArea.setText("enroll succ:\n");
                        str1 = "success";
						//send 8073 success thread7
						threadSend8073 = new Thread(new Runnable(){
							@Override
							public void run(){
								try{
								byte[] varBuffer = new byte[7];
								InetAddress varAdd = InetAddress.getByName("127.0.0.1");
								varBuffer = str1.getBytes();
								DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
								DatagramSocket ds = new DatagramSocket();
								ds.send(dp);
								System.out.println("Data sent!");
								ds.close();
								}catch (Exception e){
									e.printStackTrace();
								}
							}
						});
                		threadSend8073.start();
                		enroll_idx = 0;
                    } else {
                    	textArea.setText("enroll fail, error code=" + ret + "\n");
						str1 = "failed1";
						//send 8073 failed1 thread8
						threadSend8073 = new Thread(new Runnable(){
							@Override
							public void run(){
								try{
								byte[] varBuffer = new byte[7];
								InetAddress varAdd = InetAddress.getByName("127.0.0.1");
								varBuffer = str1.getBytes();
								DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8073);
								DatagramSocket ds = new DatagramSocket();
								ds.send(dp);
								System.out.println("Data sent!");
								ds.close();
								}catch (Exception e){
									e.printStackTrace();
								}
							}
						});
                		threadSend8073.start();
                    }
                    bRegister = false;
                } else {
                	textArea.setText("You need to press the " + (3 - enroll_idx) + " times fingerprint\n");
                }
			}
			else
			{
				if (bIdentify)
				{
					int[] fid = new int[1];
					int[] score = new int [1];
					int ret = FingerprintSensorEx.DBIdentify(mhDB, template, fid, score);
                    if (ret == 0)
                    {
                    	textArea.setText("Identify succ, fid=" + fid[0] + ",score=" + score[0] +"\n");
                    	str1 = Integer.toString(fid[0]);
						//Send 8078 thread1
						threadSend8078 = new Thread(new Runnable(){
							@Override
							public void run(){
								try{
								byte[] varBuffer = new byte[100];
								InetAddress varAdd = InetAddress.getByName("127.0.0.1");
								
								varBuffer = str1.getBytes();
								
								DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8078);
								
								DatagramSocket ds = new DatagramSocket();
								ds.send(dp);
								
								System.out.println("Data sent!");
								ds.close();
								}catch (Exception e){
									e.printStackTrace();
								}
							}
						});
                		threadSend8078.start();
                    }
                    else
                    {
                    	textArea.setText("Identify fail, errcode=" + ret + "\n");
						str1 = "error";
						//Send 8078 thread4
						threadSend8078 = new Thread(new Runnable(){
							@Override
							public void run(){
								try{
								byte[] varBuffer = new byte[100];
								InetAddress varAdd = InetAddress.getByName("127.0.0.1");
								
								varBuffer = str1.getBytes();
								
								DatagramPacket dp = new DatagramPacket(varBuffer,varBuffer.length,varAdd,8078);
								
								DatagramSocket ds = new DatagramSocket();
								ds.send(dp);
								
								System.out.println("Data sent!");
								ds.close();
								}catch (Exception e){
									e.printStackTrace();
								}
							}
						});
                		threadSend8078.start();
                    
                    }
                        
				}
				else
				{
					if(cbRegTemp <= 0)
					{
						textArea.setText("Please register first!\n");
					}
					else
					{
						int ret = FingerprintSensorEx.DBMatch(mhDB, lastRegTemp, template);
						if(ret > 0)
						{
							textArea.setText("Verify succ, score=" + ret + "\n");
						}
						else
						{
							textArea.setText("Verify fail, ret=" + ret + "\n");
						}
					}
				}
			}
		}
		
		public JSONArray makeHTTPRequest(String url,String method,List<NameValuePair> params){
			InputStream is = null;
			String json = "";
			JSONObject jObj = null;
			JSONArray jsnArr = new JSONArray();
			
			try{
				if(method=="POST"){
					DefaultHttpClient httpClient = new DefaultHttpClient();
					HttpPost httpPost = new HttpPost(url);
					httpPost.setEntity(new UrlEncodedFormEntity(params));
					
					HttpResponse httpResponse = httpClient.execute(httpPost);
					HttpEntity httpEntity = httpResponse.getEntity();
					is = httpEntity.getContent();
				}else if (method == "GET"){
					DefaultHttpClient httpClient = new DefaultHttpClient();
					String paramString = URLEncodedUtils.format(params, "utf-8");
					url += "?"+paramString;
					
					HttpGet httpGet = new HttpGet(url);
					HttpResponse httpResponse = httpClient.execute(httpGet);
					HttpEntity httpEntity = httpResponse.getEntity();
					is = httpEntity.getContent();
				}
				BufferedReader reader = new BufferedReader(new InputStreamReader(is,"iso-8859-1"),8);
				StringBuilder sb = new StringBuilder();
				String line = null;
				
				while((line=reader.readLine())!=null){
					sb.append(line+"\n");
				}
				is.close();
				json = sb.toString();
				jObj = new JSONObject(json);
				jsnArr.put(jObj);

			}catch(JSONException e){
				try{
					jsnArr = new JSONArray(json);
				}catch(JSONException e1){
					e1.printStackTrace();
				}
			}catch(Exception ee){
				ee.printStackTrace();
			}
			
			return jsnArr;
		}

		public void makeHTTPRequest1(String url,String method,List<NameValuePair> params){
			InputStream is = null;
			
			try{
				if(method=="POST"){
					DefaultHttpClient httpClient = new DefaultHttpClient();
					HttpPost httpPost = new HttpPost(url);
					httpPost.setEntity(new UrlEncodedFormEntity(params));
					
					HttpResponse httpResponse = httpClient.execute(httpPost);
					HttpEntity httpEntity = httpResponse.getEntity();
					is = httpEntity.getContent();
				}else if (method == "GET"){
					DefaultHttpClient httpClient = new DefaultHttpClient();
					String paramString = URLEncodedUtils.format(params, "utf-8");
					url += "?"+paramString;
					
					HttpGet httpGet = new HttpGet(url);
					HttpResponse httpResponse = httpClient.execute(httpGet);
					HttpEntity httpEntity = httpResponse.getEntity();
					is = httpEntity.getContent();
				}
			}catch(Exception ee){
				ee.printStackTrace();
			}
		}
		
		public static void main(String[] args) {
			new FingerprintSKPM().launchFrame();
		}
}


