CREATE DATABASE IF NOT EXISTS quanlynhansu_db;
use quanlynhansu_db;

CREATE table if not exists PhongBan (
	MaPB int(11) auto_increment 	 comment "Mã phòng ban - Là khóa chính",
    TenPB varchar(255) default null  comment "Tên phòng ban",
    DiaChi varchar(255) default null comment "Địa chỉ phòng ban",
    SDTPB  varchar(255) default null comment "Số điện thoại phòng ban",
    primary key (MaPB)
);

CREATE table if not exists ChucVu(
	MaCV int(11) auto_increment comment "Mã công việc - Là khóa chính",
    TenCV varchar(255) default null,
    primary key (MaCV)
);

CREATE table if not exists Luong (
	BacLuong int(5) default 0 	comment "Bậc lương - là khóa chính",
    LuongCB int(11) 			comment "Mức lương cơ bản",
    HSL int(11) 				comment "Hệ số lương",
    PhuCap int(11) 				comment "Phụ cấp",
    primary key (BacLuong)
);

create table if not exists TrinhDoHocVan (
	MaTDHV int(11) auto_increment,
    TenTDHV varchar(255) default null,
    ChuyenNganh varchar(255) default null,
    primary key	(MaTDHV)
);

CREATE table if not exists NhanVien (
	MaNV int(11) auto_increment comment "Mã nhân viên - là khóa chính",
    HoTen varchar(255) not null comment "Tên nhân viên",
    NgaySinh date not null 		comment "Ngày sinh",
    QueQuan	varchar(255) default null comment "Quê quán",
    GioiTinh int(1) default 0,
    SDT varchar(255) default null,
    MaPB int(11) 				comment "Là khóa ngoại liên kết với bảng phòng ban",
    MaCV int(11) 				comment "Là khóa ngoại liên kết với bảng công việc",
    MaTDHV int(11) 				comment "Là khóa ngoại liên kết với bảng trình độ học vấn",
    BacLuong int(5) 			comment "Là khóa ngoại liên kết với bảng lương",
    primary key (MaNV),
    foreign key (MaPB) references PhongBan(MaPB),
    foreign key (MaCV) references ChucVu(MaCV),
    foreign key (MaTDHV) references TrinhDoHocVan(MaTDHV),
    foreign key (BacLuong) references Luong(BacLuong)
);

CREATE table if not exists HopDongLaoDong (
	MaHD int(11) auto_increment comment "Mã hợp đồng - là khóa chính",
    MaNV int(11),
    ThoiHan int(11),
    TuNgay date,
    DenNgay date,
    primary key (MaHD),
    foreign key (MaNV) references NhanVien(MaNV)
);

CREATE table if not exists quantrivien(
    id int(11) auto_increment,
    username varchar(255),
    password varchar(255),
    avatar varchar(255),
    primary key (id)
);