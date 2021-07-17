<!--DOCTYPE html-->
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adlogin'])==0)
	{	
echo "<script type='text/javascript'> alert('Please Login as admin First!'); </script>";
header('location: loginpage/usermanagement/admin/index.php');
}

else{

	if(isset($_GET['mint']))
	{
	$assetname = $_GET['mint'];
	$description = $_GET['minty'];
	/*$id = $_GET['mint'];
	
	$sql = "SELECT * from  feedback where id = :id";	
	$query = $dbh -> prepare($sql);

	$query-> bindParam(':id', $id, PDO::PARAM_STR);
	$query->execute();
	$results =$query->fetchAll(PDO::FETCH_OBJ);
		foreach($results as $result){
	$assetname = $result->title;
	$description = $result->feedbackdata;
	 }
	*/
	


	 /*try {

		$stmt = $pdo->prepare('SELECT * FROM people WHERE id = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
		}catch(PDOException $e) {
			exit( $e->getMessage() );
		}
		
		//optional method
		//foreach($stmt as $row) {
		//	  echo $row['id'] . ' ' . $row['name'] . ' ' . $row['email'];
		//}
		
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		  $id = $row['id'];
		  $assetname = $row['title'];
		  $description = $row['feedbackdata'];
		}
		
		echo $id;
		echo $assetname;
		echo $description;


		*/
	}
	

?>
<html lang="en">
<head>
	<title>AsseNFT minter</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"-->
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"-->
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"-->
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"-->
<!--===============================================================================================-->
	<!--link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/mainly.css">
<!--===============================================================================================-->
</head>
<body>
<div class= "container-contact100-form-btn">
	<!--button id = "" class="contact100-form-btn">
		<span>
			<a href="loginpage/usermanagement/admin/feedback.php"> List of AsseNFT queries </a>
			<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
		</span>
	</button-->
	<button id = "" class= "contact100-form-btn">
		<span>
			<a href= "images/svdv.png"> Salvage Values Table </a>
			<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
		</span>
	</button>

</div>

	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<div class="contact100-form-title" style="background-image: url(images/bg-01.jpg);">
				<span class="contact100-form-title-1">
					Please provide the details
				</span>

				<!--span class="contact100-form-title-2">
					Feel free to drop us a line below!
				</span-->
			</div>

			<form class="contact100-form validate-form">
				<div class="wrap-input100 validate-input" data-validate="">
					<span class="label-input100">Asset TokenId:</span>
					<input name = "tokenid" class="input100" type="text" id="tokenid" placeholder="Enter the Id">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="">
					<span class="label-input100"> Asset Name:</span>
					<input name = "nname"class="input100" type="text" id="nname" readonly required value="<?php echo htmlentities($assetname);?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="">
					<span class="label-input100"> URI:  </span>
					<input name = "uri"class="input100" type="text" id="uri" placeholder="Enter URI">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="">
					<span class="label-input100"> Depreciation value:  </span>
					<input name = "nftdv"class="input100" type="text" id="nftdv" placeholder="Enter Depreciation Value">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="">
					<span class="label-input100"> Salvage value:  </span>
					<input name = "nftsv"class="input100" type="text" id="nftsv" placeholder="Enter Salvage Value">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Description:</span>

					<input class="input100" name="nftdescription" id = "nftdescription" readonly required value="<?php echo htmlentities($description);?>"> 

					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button id = "submit" class="contact100-form-btn" name="submit" type="submit">
						<span>
							<a href="nftmint2.php">Submit</a>
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>

		</div>
	</div>

  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src=https://cdn.jsdelivr.net/npm/web3@1.3.6/dist/web3.min.js></script>

  
    <script>
     async function CheckMetamaskConnection(){
       if(window.ethereum){
         window.web3 = new Web3(window.ethereum);
         try {
           await ethereum.enable();
           return true;
         } catch(error){
           return false;
         }
        }
        else if (window.web3) {
          window.web3 = new Web3(web3.currentProvider);
          return true;
        }
        else {
          console.log('non-eth browser detected use metamask');
          return false;
        }
     }

     var contaddress = "0xA394e00185fDE6b0EED90122399461AaF96935ad";
		
 var abi = [
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "_approved",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "Approval",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "_operator",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "bool",
				"name": "_approved",
				"type": "bool"
			}
		],
		"name": "ApprovalForAll",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "previousOwner",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "newOwner",
				"type": "address"
			}
		],
		"name": "OwnershipTransferred",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "_from",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "_to",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "Transfer",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "address",
				"name": "owneraddress",
				"type": "address"
			}
		],
		"name": "eventaddress",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "nftname",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "address",
				"name": "owneraddress",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "blocknumber",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "blocktimestamp",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "ipfsurl",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "description",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "salvagevalue",
				"type": "uint256"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "deprecitionvalue",
				"type": "uint256"
			}
		],
		"name": "eventdetails",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "length",
				"type": "uint256"
			}
		],
		"name": "eventlength",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_approved",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "approve",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			}
		],
		"name": "balanceOf",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "getAddress",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "getApproved",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "getDetails",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getLength",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "_operator",
				"type": "address"
			}
		],
		"name": "isApprovedForAll",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			},
			{
				"internalType": "address",
				"name": "_to",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_uri",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_description",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_salvageValue",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "_depreciationValue",
				"type": "uint256"
			}
		],
		"name": "mint",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "name",
		"outputs": [
			{
				"internalType": "string",
				"name": "_name",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "owner",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "ownerOf",
		"outputs": [
			{
				"internalType": "address",
				"name": "_owner",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "renounceOwnership",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_from",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "_to",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "safeTransferFrom",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_from",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "_to",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			},
			{
				"internalType": "bytes",
				"name": "_data",
				"type": "bytes"
			}
		],
		"name": "safeTransferFrom",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_operator",
				"type": "address"
			},
			{
				"internalType": "bool",
				"name": "_approved",
				"type": "bool"
			}
		],
		"name": "setApprovalForAll",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "bytes4",
				"name": "_interfaceID",
				"type": "bytes4"
			}
		],
		"name": "supportsInterface",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "symbol",
		"outputs": [
			{
				"internalType": "string",
				"name": "_symbol",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "tokenURI",
		"outputs": [
			{
				"internalType": "string",
				"name": "",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "_from",
				"type": "address"
			},
			{
				"internalType": "address",
				"name": "_to",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "_tokenId",
				"type": "uint256"
			}
		],
		"name": "transferFrom",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "newOwner",
				"type": "address"
			}
		],
		"name": "transferOwnership",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	}
];
	var mycontract;
    $(document).ready(async function(){

	var IsMetamask = await CheckMetamaskConnection();
    if(IsMetamask){
			
      mycontract = new web3.eth.Contract(abi,contaddress);
      console.log("mycontract:", mycontract);
      console.log('metamask detected');
    }
    else{
      console.log('metamask not detected');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'metamask not detected',
        onClose(){
          location.reload();
        }
      });
    }
	

	});
  
	$('#submit').click(async function()
	{
	  var ag1 = parseInt($('#tokenid').val());
      var ag2 = $('#nname').val();
      var ag3 = $('#uri').val();
	  var ag4 = parseInt($('#nftdv').val());
	  var ag5 = parseInt($('#nftsv').val());
	  var ag6 = $('#nftdescription').val();

      sessionStorage.setItem('balayya1',ag1);
	  sessionStorage.setItem('balayya2',ag2);
	  sessionStorage.setItem('balayya3',ag3);
  	  sessionStorage.setItem('balayya4',ag4);
	  sessionStorage.setItem('balayya5',ag5);
      sessionStorage.setItem('balayya6',ag6);
	});

	</script>




	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<!--script src="vendor/animsition/js/animsition.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/select2/select2.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/countdowntime/countdowntime.js"></script-->
<!--===============================================================================================-->
	<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script-->
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>

</body>
</html>

<?php } ?>