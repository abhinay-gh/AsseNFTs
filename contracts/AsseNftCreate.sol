pragma solidity >=0.4.22 <0.9.0;
// SPDX-License-Identifier: MIT
import "./tokens/nf-token-metadata.sol";
import "./ownable.sol";
 
contract NftCreate is NFTokenMetadata, Ownable {
  uint totalNfts =0;
  struct NFTdetail{
    string NFTname;
    address ownerAddress;
    uint tokenId;
    uint blockNumber;
    uint blockTimeStamp;
    string ipfsUrl;
    string description;
    uint salvageValue;
    uint depreciationValue;
  }

  NFTdetail[] nftlist ;
  constructor() {
    nftSymbol = "SYN";
  }
  mapping (uint256 => NFTdetail) infomap;
  function mint(string memory _name,address _to, uint _tokenId, string calldata _uri, string memory _description, uint _salvageValue,uint _depreciationValue) external onlyOwner {
    super._mint(_to, _tokenId);
    super._setTokenUri(_tokenId, _uri);
    string memory ipfsurl = _uri;   
    nftlist.push(NFTdetail(_name,_to,_tokenId, block.number,block.timestamp,ipfsurl,_description,_salvageValue,_depreciationValue));
    infomap[_tokenId] = NFTdetail(_name,_to,_tokenId, block.number,block.timestamp,ipfsurl,_description,_salvageValue,_depreciationValue);
    totalNfts++;
  }
  event eventdetails(
    string nftname,
    address owneraddress,
    uint blocknumber,
    uint blocktimestamp,
    string ipfsurl,
    string description,
    uint salvagevalue,
    uint deprecitionvalue

  );
  event eventaddress(
    address owneraddress
  );
  event eventlength(
    uint length
  );
  function getAddress(uint256 _tokenId) public 
  {
    emit eventaddress(infomap[_tokenId].ownerAddress);
  }
  function getLength() public 
  {
    emit  eventlength(totalNfts);
  }
  function getDetails(uint256 _tokenId) public 
  //view returns (string memory, address)
  {
     emit eventdetails(infomap[_tokenId].NFTname,infomap[_tokenId].ownerAddress,infomap[_tokenId].blockNumber,infomap[_tokenId].blockTimeStamp,infomap[_tokenId].ipfsUrl,infomap[_tokenId].description,infomap[_tokenId].salvageValue,infomap[_tokenId].depreciationValue);
  }
  
}
