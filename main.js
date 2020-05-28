var app = new Vue ({
    el: '#app',
    data: {
        errorMsg: "",
        successMsg: "",
        showAddModal:false,
        showEditModal:false,
        showDeleteModal:false,
        tugasvue:[],
        newTugas: {Tugas: "",Keterangan: ""},
        currentTugas:{}
    },
    mounted: function(){
        this.getAllTugas();
    },
    methods:{ 
        getAllTugas(){
            axios.get("http://localhost:81/DOT-Daftar%20Tugas/proses.php?action=read").then(function(response){
                if(response.data.error){
                    app.errorMsg = response.data.message;
                }
                else{
                    app.tugasvue = response.data.tugasvue;
                }
            });
        },
        addTugas(){
            var formData = app.toFormData(app.newTugas);
            axios.get("http://localhost:81/DOT-Daftar%20Tugas/proses.php?action=create").then(function(response){
            app.newTugas = {Tugas: "", Keterangan: ""};   
            if(response.data.error){
                    app.errorMsg = response.data.message;
                }
                else{
                    app.successMsg = response.data.message;
                    app.getAllTugas(); 
                }
            });
        },
        toFormData(obj){
            var fd = new FormData();
            for(var i in obj){
                fd.append(i,obj[i]);
            }
            return fd;
        },
    }
});