resource "aws_db_subnet_group" "default" {
  name       = "${var.name_prefix}-subnet-group"
  subnet_ids = var.subnet_ids

  tags = {
    Name = "${var.name_prefix}-subnet-group"
  }
}

resource "aws_db_instance" "mysql" {
  identifier              = "${var.name_prefix}-db"
  engine                  = "mysql"
  engine_version          = "8.0"
  instance_class          = "db.t3.micro"
  allocated_storage       = 20
  storage_type            = "gp2"
  db_name                 = var.db_name
  username                = var.db_username
  password                = var.db_password
  db_subnet_group_name    = aws_db_subnet_group.default.name
  vpc_security_group_ids  = [var.db_sg_id]
  skip_final_snapshot     = true
  backup_retention_period = 7
  publicly_accessible     = false
  multi_az                = false
  apply_immediately       = true

  tags = {
    Name = "${var.name_prefix}-mysql-db"
  }
}