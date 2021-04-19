const jobGood = document.querySelector(".job-good");
const jobAttractive = document.querySelector(".job-attractive");
const jobUrgently = document.querySelector(".job-urgently");
const jobHighPaying = document.querySelector(".job-high-paying");
const jobManager = document.querySelector(".job-manager");
const jobIntern = document.querySelector(".job-intern");
const jobFreeTime = document.querySelector(".job-free-time");
const jobRemote = document.querySelector(".job-remote");
getLazyJob({ className: jobAttractive, jqueryClass: "job-attractive", deploy: ".job-attractive .row", ajax: "ajax-get-job/service/viec-lam-hap-dan", classCol: "col-md-6 col-xs-12" });
getLazyJob({ className: jobGood, jqueryClass: "job-good", deploy: ".job-good .row", ajax: "ajax-get-job/service/viet-lam-tot-nhat", classCol: "col-lg-4 col-md-6 col-xs-12" });
getLazyJob({ className: jobUrgently, jqueryClass: "job-urgently", deploy: ".job-urgently .list-job", ajax: "ajax-get-job/service/viec-lam-tuyen-dung-gap", classCol: "col-12" });
getLazyJob({ className: jobHighPaying, jqueryClass: "job-high-paying", deploy: ".job-high-paying .list-job", ajax: "ajax-get-job/service/viec-lam-luong-cao", classCol: "col-12" });
getLazyJob({ className: jobManager, jqueryClass: "job-manager", deploy: ".job-manager .list-job", ajax: "ajax-get-job/service/viec-lam-cap-quan-ly", classCol: "col-12" });
getLazyJob({ className: jobIntern, jqueryClass: "job-intern", deploy: ".job-intern .list-job", ajax: "ajax-get-job/type/viec-lam-thuc-tap", classCol: "col-12" });
getLazyJob({ className: jobIntern, jqueryClass: "job-free-time", deploy: ".job-free-time .list-job", ajax: "ajax-get-job/type/ban-thoi-gian", classCol: "col-12" });
getLazyJob({ className: jobIntern, jqueryClass: "job-remote", deploy: ".job-remote .list-job", ajax: "ajax-get-job/type/viec-lam-tu-xa", classCol: "col-12" });

function getLazyJob({ className, jqueryClass, deploy, ajax, classCol }) {
    const effectPackage = { 7: "title-red", 8: "title-hot", 9: "title-good" };
    let ajaxJob = false;
    window.addEventListener('scroll', function() {
        if (ajaxJob) return;
        let checkJob = className.getBoundingClientRect().bottom - $(`.${jqueryClass}`).height() - this.innerHeight;
        if (checkJob < -20 && !ajaxJob) {
            ajaxJob = true;
            $.get(ajax, function(data) {
                let html = ''
                data.data.jobs.forEach(job => {
                    // css package effect
                    let wage = "Thỏa thuận";
                    if (job.Wage_To || job.Wage_From) {
                        wage = job.Wage_To ? `Đến ${currencyFormat(job.Wage_To)}` : `Từ ${currencyFormat(job.Wage_From)}`;
                    }
                    if (job.Wage_To > 0 && job.Wage_From > 0) {
                        wage = `Từ ${currencyFormat(job.Wage_From)} Đến ${currencyFormat(job.Wage_To)}`;
                    }
                    let classEffect = effectPackage[job.Effect] || "";
                    html += `<div class="${classCol}">
                                    <div class="job-featured ${classEffect}">
                                        <div class="icon">
                                            <img class="lazy" src="${baseAsset}/${job.Company_Logo}">
                                        </div>
                                        <div class="content">
                                            <h3><a class="job-title" href="viec-lam/${job.Job_Slug}">${strLimit(job.Job_Title,20)}</a></h3>
                                            <p class="brand">${job.Company_Name}</p>
                                            <div class="tags">
                                                <span><i class="lni-map-marker"></i>${job.Province_Name}</span>
                                                <small class="d-block"><i class="far fa-money-bill-alt"></i> ${wage}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                });
                $(deploy).html(html);
            })
        }
    })

}