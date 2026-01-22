document.addEventListener("DOMContentLoaded", function () {

    console.log("TASK:", taskCount);
    console.log("DOCS:", docCount);
    console.log("USERS:", userCount);

    const ctx = document.getElementById("myChart");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Tasks", "Documents", "Users"],
            datasets: [{
                label: "Total Count",
                data: [Number(taskCount), Number(docCount), Number(userCount)],
                backgroundColor: ["#3498db", "#f1c40f", "#2ecc71"],
                borderColor: ["#2980b9", "#d4ac0d", "#27ae60"],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

});
