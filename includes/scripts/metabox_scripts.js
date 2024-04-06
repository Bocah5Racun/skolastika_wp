const addJob = document.getElementById("add_job");
const addExperience = document.getElementById("add_experience");

const jobList = document.getElementById("job-list");
const experienceList = document.getElementById("experience-list");

addJob.addEventListener("click", () => {
  const children = jobList.children.length - 1;
  jobList.append(
    Object.assign(document.createElement("li"), {
      innerHTML: `
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
      className: "job-list-item",
    })
  );
});
