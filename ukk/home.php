
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
94
95
96
97
98
99
100
101
102
103
104
105
106
107
108
109
110
111
112
113
114
115
116
117
118
119
120
121
122
123
124
125
126
127
128
129
130
131
132
133
134
135
136
137
138
139
140
141
142
143
144
145
146
147
148
149
150
151
152
153
154
155
156
157
158
159
160
161
162
163
164
165
166
167
168
169
170
171
172
173
174
175
176
177
178
179
180
181
<?php 
 
session_start(); 
error_reporting(0); 
if (isset($_SESSION["login"])) {
    header('location: login.php');
    exit;
 
}
 
?>
<marquee>Selamat Datang di Halaman Utama One-IT Library</marquee>
<!-- /. NAV SIDE  -->
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 style="color: black;">Admin One-IT Library</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-users"></i>
                </span>
                <div class="text-box" >
                    <b><?php
                  
                $mahasiswa= mysqli_query($mysqli,"SELECT * FROM tb_anggota");
                  
                $jumlah_mahasiswa = mysqli_num_rows($mahasiswa);
 
                ?>
                <p style="font-size: 20px;"><?php echo $jumlah_mahasiswa; ?> Anggota</p></b>
                <a href="?page=anggota">
                    <p class="text-muted">Lihat Detail</p></a>
                </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-book"></i>
                </span>
                <div class="text-box" >
                    <b><?php
                  
                $mahasiswa= mysqli_query($mysqli,"SELECT * FROM tb_buku");
                  
                $jumlah_mahasiswa = mysqli_num_rows($mahasiswa);
 
                ?>
                <p style="font-size: 20px;"><?php echo $jumlah_mahasiswa; ?> Buku</p></b>
                    <a href="?page=buku">
                    <p class="text-muted">Lihat Detail</p></a>
                </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-database"></i>
                </span>
                <div class="text-box" >
                    <b><?php
                  
                $mahasiswa= mysqli_query($mysqli,"SELECT * FROM tb_transaksi");
                  
                $jumlah_mahasiswa = mysqli_num_rows($mahasiswa);
 
                ?>
                <p style="font-size: 20px;"><?php echo $jumlah_mahasiswa; ?> Transaksi</p></b>
                <a href="?page=transaksi">
                    <p class="text-muted">Lihat Details</p></a>
                </div>
             </div>
             </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-user"></i>
                </span>
                <div class="text-box" >
                    <b><?php
                  
                $mahasiswa= mysqli_query($mysqli,"SELECT * FROM tb_user");
                  
                $jumlah_mahasiswa = mysqli_num_rows($mahasiswa);
 
                ?>
                <p style="font-size: 20px;"><?php echo $jumlah_mahasiswa; ?> User</p></b>
                    <p class="text-muted">Lihat Details</p>
                </div>
             </div>
             </div>
            </div>
 
 
    <div class="row" style="margin-top: 30px;">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Anggota Terlambat Pengembalian Buku
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Terlambat</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <?php
                                            $transaksi = $mysqli->query("SELECT * FROM tb_transaksi WHERE status='pinjam'");
                                            $no = 0;
                                            while( $t = $transaksi->fetch_assoc()){
                                            $no++;
                                         ?>
 
                                        <tr>
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $t["nama"]; ?></td>
                                            <td><?= $t["tgl_pinjam"]; ?></td>
                                            <td><?= $t["tgl_kembali"]; ?></td>
                                            <td>
                                                <?php
 
                                                $denda = 5000;
 
                                                $tgl_deadline = $t['tgl_kembali'];
                                                $tgl_kembali = date('Y-m-d');
 
                                                $lambat = terlambat($tgl_deadline,$tgl_kembali);
                                                $denda1 = $lambat*$denda;
 
                                                if ($lambat>0) {
                                                    echo"<font color='red'>$lambat hari<br>(Rp. $denda1)</font>";
                                                }else{
                                                    echo " ".$lambat." hari";
                                                }
                                                ?>
                                             </td>
                                            <td><?= $t["status"]; ?></td>
                                          <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                           <div class="col-md-4 col-sm-4">
                    <div class="panel panel-success">
                    </div>
                </div>
            </div>
        </div>    
            <div class="col-md-4 col-sm-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            One-IT Library
                        </div>
                        <div class="panel-body">
                            <p><center>Selamat datang di One-IT Library <br>
                            Sebuah perpustakaan digital yang memberikan kemudahan dalam mengelola data perpustakaan One-IT University</p></center>
                        </div>
                        <div class="panel-footer">
                            Introduction
                        </div>
                    </div>
                </div>
            </div>
 
            <?php include "koneksi.php"; ?>