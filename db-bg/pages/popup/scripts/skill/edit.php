var totalField = 'totalStats';


var lpFieldElement = document.getElementById('lp');
var kpFieldElement = document.getElementById('kp');
var aFieldElement = document.getElementById('attack');
var dFieldElement = document.getElementById('defense');
var valueMap = new Map();
valueMap.set('lp', Number(lpFieldElement.value));
valueMap.set('kp', Number(kpFieldElement.value));
valueMap.set('attack', Number(aFieldElement.value));
valueMap.set('defense', Number(dFieldElement.value));

function statsIncrease(fieldName)
{
  
  var stats = valueMap.get(fieldName);
  changeStats(fieldName, stats, stats + 1);
  
}
function statsDecrease(fieldName)
{
  var stats = valueMap.get(fieldName);
  changeStats(fieldName, stats, stats - 1);
  
}

function statsChanged(fieldName, e)
{
  var previousValue = valueMap.get(fieldName);
  var statsFieldElement = document.getElementById(fieldName);
  var newValue = Number(statsFieldElement.value);

  changeStats(fieldName, previousValue, newValue);
  
}

function changeStats(fieldName, previousValue, newValue)
{
  if(newValue < 0)
    newValue = 0;
  
  var totalFieldElement = document.getElementById(totalField);
  var statsFieldElement = document.getElementById(fieldName);
  
  var totalStats = Number(totalFieldElement.innerHTML);
  
  //TotalStats = 10
  //PreviousValue = 5
  //newValue = 20
  var difference = previousValue - newValue;
  //Difference = -15
  
  if(difference != 0)
  {
    totalStats = totalStats + difference;
    //10 - 15 = -5
    if(totalStats < 0)
    {
      newValue = newValue + totalStats;
      //20 - 5 = 15
      totalStats = 0;
    }
    totalFieldElement.innerHTML = totalStats;
    statsFieldElement.value = newValue;
    valueMap.set(fieldName, newValue);
  }
  return false;
}