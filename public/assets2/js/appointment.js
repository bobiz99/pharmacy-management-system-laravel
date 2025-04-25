$(document).ready(function () {
   $.ajax({
       url: '/dashboard/appointments',
       method: 'GET',
       success: function (data) {
           console.log(data);
           printAppointments(data)
       },
       error: function (error) {
           console.log(error);
       }
   })
});

function printAppointments(data) {
    let html = '';
    data.appointment.forEach(d => {
        html += `
            <tr>
                <td scope="row">#${d.id}</td>
                <td>${d.patient.user.first_name} ${d.patient.user.last_name}</td>
                <td>${d.appointment_time}</td>
                <td><span class="badge `;
        if (d.status === 'completed') {
            html += 'bg-success'
        } else if(d.status === 'scheduled') {
            html += 'bg-warning'
        } else if(d.status === 'cancelled') {
            html += 'bg-danger'
        }

        html +=`">${d.status}</span></td>
            </tr>
        `;
    });
    $('#doctorAppointments').html(html);
}
