const labels = ['January', 'February', 'March', 'April', 'May', 'June']


const data = {
    labels:labels,
    datasets :[
        {
            label:'Temperature 1',
            backgroundColor:"blue",
            borderColor:'blue',
            data: [1, 2, 1, 1, 1, 1],
            tension:0.4,
        },

        {
            label:'Humidity 1',
            backgroundColor:"red",
            borderColor:'red',
            data: [20, 10, 50, 16, 12, 90],
            tension:0.4,
        },

        {
            label:'Air quality 1',
            backgroundColor:"green",
            borderColor:'green',
            data: [5, 50, 20, 30, 10, 69],
            tension:0.4,
        }
    ]
}

const config = {
    type: 'line',
    data: data,
}
const canvas = document.getElementById('canvas')
const chart = new Chart(canvas,config)