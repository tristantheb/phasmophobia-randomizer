document.addEventListener("DOMContentLoaded", function () {
  const $selectorsYes = document.querySelectorAll('.has_evid');
  const $selectorsNo = document.querySelectorAll('.hasnt_evid');
  const $rows = document.querySelectorAll(".evid_row");
  const $clearAll = document.querySelector("#btnClear");
  resetAll();

  $selectorsYes.forEach(selector => {
    selector.addEventListener('click', updateEvidenceTracker);
  });
  $selectorsNo.forEach(selector => {
    selector.addEventListener('click', updateUnevidenceTracker);
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

  /**
   * 
   * @param {boolean=true} r Represent the activation for the reset mode
   */
  function updateEvidenceTracker(r = true) {
    // Reset
    if (r) resetRows();
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
    if (r) {
      updateUnevidenceTracker(false);
    }
  }

  /**
   * 
   * @param {boolean=true} r Represent the activation for the reset mode
   */
  function updateUnevidenceTracker(r = true) {
    // Reset
    if (r) resetRows();
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
    if (r) {
      updateEvidenceTracker(false);
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
    ]
  }
}