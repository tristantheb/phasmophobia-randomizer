document.addEventListener("DOMContentLoaded", function () {
  const $selectorsYes = document.querySelectorAll('.has_evid');
  const $selectorsNo = document.querySelectorAll('.hasnt_evid');
  const $rows = document.querySelectorAll(".evid_row");
  const $clearAll = document.querySelector("#btnClear");
  const $ghostNames = document.querySelectorAll('.evid_row th');
  resetAll();

  $selectorsYes.forEach(selector => {
    selector.addEventListener('change', updateTable);
  });
  $selectorsNo.forEach(selector => {
    selector.addEventListener('change', updateTable);
  });
  
  $ghostNames.forEach(row => {
    row.addEventListener('click', () => {ghostInfo(row);});
  });

  $clearAll.addEventListener('click', resetAll);

  function getCheckedEvidence() {
    let checkedEvidences = [];
    $selectorsYes.forEach(selector => {
      if (selector.checked) {
        checkedEvidences.push(selector.dataset.evidcheck);
      }
    });

    return checkedEvidences;
  }

  function getCheckedUnevidence() {
    let checkedUnevidences = [];
    $selectorsNo.forEach(selector => {
      if (selector.checked) {
        checkedUnevidences.push(selector.dataset.evidcheck);
      }
    });

    return checkedUnevidences;
  }

  function updateTable() {
    resetRows();
    updateEvidenceTracker();
    updateUnevidenceTracker();
  }

  /**
   * 
   * @param {boolean=true} reset Represent the activation for the reset mode
   */
  function updateEvidenceTracker() {
    // Init
    const evidencesObject = ghostEvidences();
    const evidencesArray = Object.entries(evidencesObject);
    const checkEvidArray = getCheckedEvidence();
    
    if (!checkEvidArray.length) return;

    for (const [ghost, evidence] of evidencesArray) {
      const $cell = document.querySelector('#' + ghost + '');
      // Flag check if all evidences id present
      let hasEvidences = true;

      checkEvidArray.forEach(evidType => {
        if (!evidence.includes(evidType)) {
          hasEvidences = false;
        }
      });

      if (hasEvidences) {
        $cell.classList.add('row-active');
      } else {
        $cell.classList.add('row-negative');
      }
    }
  }

  /**
   * 
   * @param {boolean=true} reset Represent the activation for the reset mode
   */
  function updateUnevidenceTracker() {
    // Init
    const evidencesObject = ghostEvidences();
    const evidencesArray = Object.entries(evidencesObject);
    const checkEvidArray = getCheckedUnevidence();
    
    if (!checkEvidArray.length) return;

    for (const [ghost, evidence] of evidencesArray) {
      const $cell = document.querySelector('#' + ghost + '');

      checkEvidArray.forEach(evidType => {
        if (evidence.includes(evidType)) {
          $cell.classList.add('row-disabled');
        }
      });
    }
  }

  function resetAll() {
    $selectorsYes.forEach(sel => {
      sel.checked = false;
    });
    $selectorsNo.forEach(sel => {
      sel.checked = false;
    });
    resetRows();
  }

  function resetRows() {
    $rows.forEach(row => {
      row.classList.remove('row-active', 'row-disabled', 'row-negative');
    });
  }

  function ghostInfo(htmlElement) {
    let id = htmlElement.parentElement;
    id = id.getAttribute('id'), ghostList = ghostPowers();
    ghostList = Object.entries(ghostList);
    ghostList.forEach(ghost => {
      if (ghost[0] === id) {
        let $ghostInfo = document.querySelector("#ghostInfo");
        $ghostInfo.innerHTML = '<h4><i class="fa fa-ghost"></i> ' + ghost[1].name + '</h4>';
        $ghostInfo.innerHTML += '<p><i class="fa fa-plus-circle"></i> ' + ghost[1].power + '</p>';
        $ghostInfo.innerHTML += '<p><i class="fa fa-minus-circle"></i> ' + ghost[1].weakness + '</p>';
      }
    });
  }
});

function ghostEvidences() {
  return {
    'spirit': [
      'spirit-box',
      'fingerprints',
      'ghost-writing',
    ],
    'wraith': [
      'spirit-box',
      'fingerprints',
      'freezing-temp',
    ],
    'phantom': [
      'freezing-temp',
      'emf',
      'ghost-orbs',
    ],
    'poltergeist': [
      'spirit-box',
      'fingerprints',
      'ghost-orbs',
    ],
    'banshee': [
      'fingerprints',
      'freezing-temp',
      'emf',
    ],
    'jinn': [
      'spirit-box',
      'emf',
      'ghost-orbs',
    ],
    'mare': [
      'spirit-box',
      'freezing-temp',
      'ghost-orbs',
    ],
    'revenant': [
      'fingerprints',
      'ghost-writing',
      'emf',
    ],
    'shade': [
      'ghost-writing',
      'emf',
      'ghost-orbs',
    ],
    'demon': [
      'spirit-box',
      'ghost-writing',
      'freezing-temp',
    ],
    'yurei': [
      'ghost-writing',
      'freezing-temp',
      'ghost-orbs',
    ],
    'oni': [
      'spirit-box',
      'ghost-writing',
      'emf',
    ],
    'yokai': [
      'spirit-box',
      'ghost-orbs',
      'ghost-writing',
    ],
    'hantu': [
      'fingerprints',
      'ghost-orbs',
      'ghost-writing',
    ]
  }
}
