<!--DOCTYPE html-->
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) ==0 && strlen($_SESSION['adlogin']) ==0 )
	{	
echo "<script type='text/javascript'>alert('Please Login First!');</script>";
//echo "<div>PLease login first </div>";
header('location: loginpage/usermanagement/index.php');
}
else{



?>

<html lang="en">
<head>
	<title>AsseNFT viewer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
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


	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<div class="contact100-form-title" style="background-image: url(images/index.jpeg);">
				<span class="contact100-form-title-1">
					These are the details of the Asset
				</span>
				<form class="contact100-form validate-form">
					<div class="wrap-input100 validate-input" >
						<span class="label-input100"> Owner address: </span>
						<!--input class="input100" type="text" name="name" placeholder=""-->
						<output id = 'owneraddoutput'placeholder='Results are getting loaded'>  </output>
						<span class="focus-input100"></span>
					   
					</div>
					
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Asset name:</span>
						<output id = 'nftnameoutput'placeholder='Results are getting loaded'>  </output>
						<span class="focus-input100"></span>
					</div>

				
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Depreciation Value:</span>
						<!--input class="input100" type="text" name="nft name" placeholder=""-->
						<output id = 'nftdv'placeholder='Results are getting loaded'>  </output>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Salvage Value:</span>
						<!--input class="input100" type="text" name="nft name" placeholder=""-->
						<output id = 'nftsv'placeholder='Results are getting loaded'>  </output>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100"> timestamp:</span>
						<!--input class="input100" type="text" name="owner name" placeholder=""-->
						<output id = 'nfttimestamp'placeholder='Results are getting loaded'> </output>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Asset blocknumber:</span>
						<!--input class="input100" type="text" name="owner name" placeholder=""-->
						<output id = 'nftblocknumber'placeholder='Results are getting loaded'> </output>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">total Assets:</span>
						<!--input class="input100" type="text" name="owner name" placeholder=""-->
						<output id = 'totalnfts'placeholder='Results are getting loaded'> </output>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Description:</span>
						<!--input class="input100" type="text" name="nft name" placeholder=""-->
						<output id = 'nftdescription'placeholder='Results are getting loaded'> 
							<textarea class="input100" name="nftdescription" id = "nftdescription" placeholder=""></textarea>	
						</output>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100"> AsseNFT:</span>
						<!--input class="input100" type="text" name="nft displayed" placeholder=""-->
						<output id = 'nfturl'placeholder='Results are getting loaded'></output>
							<img src = "" alt = "image is getting loaded" id ='image' height ="70" width ="150"> </img>   
						
						<span class="focus-input100"></span>
					</div>

			</form>
		</div>
	</div>
	<script>var nft2 = sessionStorage.getItem('balayya');</script>
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
    web3.eth.getAccounts().then(async function(accounts){
	var acc = accounts[0];
	var bruh = await mycontract.methods.getLength().send({from: acc});
	var eventlength = bruh.events.eventlength.returnValues.length;    
	$('#totalnfts').html(eventlength);
		

	  var det = await mycontract.methods.getDetails(nft2).send({from: acc});
	  console.log(det);
	  var eventname = det.events.eventdetails.returnValues[0];
	  var eventaddress = det.events.eventdetails.returnValues[1];
	  var eventblock = det.events.eventdetails.returnValues[2];
	  var eventtime = det.events.eventdetails.returnValues[3];
	  var eventnft = det.events.eventdetails.returnValues[4];
	  var eventdescription = det.events.eventdetails.returnValues[5];
	  var eventsalvage = det.events.eventdetails.returnValues[6];
	  var eventdepreciation = det.events.eventdetails.returnValues[7];

	  $('#nftnameoutput').html(eventname);
	  $('#owneraddoutput').html(eventaddress);
	  $('#nftblocknumber').html(eventblock);
	  $('#nfttimestamp').html(eventtime);
	  $('#nftdescription').html(eventdescription);
	  $('#nftsv').html(eventsalvage);
	  $('#nftdv').html(eventdepreciation);
	 
	 let eventnfturl = new URL(eventnft);
	 document.getElementById('image').src = eventnfturl.href;
	 $('#nfturl').html(eventnfturl);
	 console.log(eventnfturl.href);
	 console.log(eventname);
	
	 }).catch(function(tx){
         console.log("babu");
         console.log(tx);
	 })
	});
   </script>

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery.min.js"></script>
<!--===============================================================================================-->
	<!--script src="vendor/animsition/js/animsition.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/select2/select2.min.js"></script-->
<!--===============================================================================================-->
	<!--script src="vendor/daterangepicker/moment.min.js"></script-->
	<!--script src="vendor/daterangepicker/daterangepicker.js"></script-->
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