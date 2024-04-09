const addJob = document.getElementById("add_job");
const addResearch = document.getElementById("add_research");

const jobList = document.getElementById("job-list");
const researchList = document.getElementById("research-list");

const moveListItem = (list, index, offset) => {
  if (Math.abs(offset) != 1) return; // only move up 1 or down 1

  const target = index + offset;

  if (target > list.length - 1) return;
  if (target < 0) return;

  const items = list.querySelectorAll("li");

  const indexValues = [...items[index].querySelectorAll("input")].map(
    (input) => input.value
  );

  const targetValues = [...items[target].querySelectorAll("input")].map(
    (input) => input.value
  );

  const indexInputs = items[index].querySelectorAll("input");
  const targetInputs = items[target].querySelectorAll("input");

  indexInputs.forEach((indexInput, indexInputIndex) => {
    indexInput.value = targetValues[indexInputIndex];
  });
  targetInputs.forEach((targetInput, targetInputIndex) => {
    targetInput.value = indexValues[targetInputIndex];
  });
};

const refreshMetaButtonListeners = () => {
  const moveUps = document.querySelectorAll(".meta-move--up");
  const moveDowns = document.querySelectorAll(".meta-move--down");

  moveUps.forEach((moveUp) => {
    moveUp.addEventListener("click", () => {
      const parentList = moveUp.parentNode.parentNode.parentNode;
      const childIndex = [
        ...moveUp.parentNode.parentNode.parentNode.children,
      ].indexOf(moveUp.parentNode.parentNode);

      moveListItem(parentList, childIndex, -1);
    });
  });

  moveDowns.forEach((moveDown) => {
    moveDown.addEventListener("click", () => {
      const parentList = moveDown.parentNode.parentNode.parentNode;
      const childIndex = [
        ...moveDown.parentNode.parentNode.parentNode.children,
      ].indexOf(moveDown.parentNode.parentNode);

      moveListItem(parentList, childIndex, 1);
    });
  });
};

refreshMetaButtonListeners();

addJob.addEventListener("click", () => {
  const children = jobList.children.length - 1;
  jobList.append(
    Object.assign(document.createElement("li"), {
      innerHTML: `
      <div class="list-item-move-container">
      </div>
      <div>
        <input id='staff_cv[job_list][${
          children + 1
        }][title]' name='staff_cv[job_list][${
        children + 1
      }][title]' class='job-list-text' type='text' placeholder='Job title' />
        </div>
        <div>
            <input id='staff_cv[job_list][${
              children + 1
            }][company]' name='staff_cv[job_list][${
        children + 1
      }][company]' class='job-list-text' type='text' placeholder='Company name' />
        </div>
        <div>
            <input id='staff_cv[job_list][${
              children + 1
            }][start]' name='staff_cv[job_list][${
        children + 1
      }][start]' class='job-list-text' type='number' size='6' step='1' inputmode='numeric' placeholder='Start' />
        </div>
        <div>
            <input id='staff_cv[job_list][${
              children + 1
            }][end]' name='staff_cv[job_list][${
        children + 1
      }][end]' class='job-list-text' type='number' step='1' size='6' inputmode='numeric' placeholder='End' />
        </div>`,
      className: "list-item",
    })
  );

  updateMetaButtons();
});

addResearch.addEventListener("click", () => {
  const children = researchList.children.length - 1;
  researchList.append(
    Object.assign(document.createElement("li"), {
      innerHTML: `
      <div class="list-item-move-container">
      </div>
      <div>
        <input id='staff_cv[research_list][${
          children + 1
        }][title]' name='staff_cv[research_list][${
        children + 1
      }][title]' class='job-list-text' type='text' placeholder='Project name' />
        </div>
        <div>
            <input id='staff_cv[research_list][${
              children + 1
            }][company]' name='staff_cv[research_list][${
        children + 1
      }][desc]' class='job-list-text' type='text' placeholder='Project description' />
        </div>
        <div>
        <input data-desc="date" type="date" class="job-list-text" id="staff_cv[research_list][${
          children + 1
        }][date]" name="staff_cv[research_list][${children + 1}][date]" />
        </div>
        `,
      className: "list-item",
    })
  );

  updateMetaButtons();
});

const updateMetaButtons = () => {
  const listItems = document.querySelectorAll(".list-item");

  listItems.forEach((listItem) => {
    const childNo = [...listItem.parentNode.children].indexOf(listItem);
    const parentLength = listItem.parentNode.children.length - 1;

    const moveItemContainer = listItem.querySelector(
      ".list-item-move-container"
    );

    /* empty .list-item-move-container, then populate with meta-move buttons, then add disabled class to top and bottom children */
    moveItemContainer.innerHTML = ""; // empty .list-item-move-container
    moveItemContainer.innerHTML = `
      <a class="meta-move meta-move--up" ${!childNo ? "disabled" : ""}>
        <img src="${GLOBALS.baseURL}/includes/images/down.png"  />
      </a>
      <a class="meta-move meta-move--down" ${
        childNo >= parentLength ? "disabled" : ""
      }>
        <img src="${GLOBALS.baseURL}/includes/images/down.png" />
      </a>
    `;
  });

  refreshMetaButtonListeners();
};
