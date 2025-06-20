# Create an RDS subnet group using the private subnets
resource "aws_db_subnet_group" "main" {
  name       = "rds-subnet-group"
  subnet_ids = [aws_subnet.private_a.id, aws_subnet.private_b.id]
}

# Create a MySQL RDS instance in private subnets, not publicly accessible
resource "aws_db_instance" "mysql" {
  identifier              = "savorpalette-db"
  allocated_storage       = 20
  storage_type            = "gp2"
  engine                  = "mysql"
  engine_version          = "8.0"
  instance_class          = "db.t3.micro"
  db_name                 = "recipe_login_db"
  username                = local.credentials.username
  password                = local.credentials.password
  skip_final_snapshot     = true
  publicly_accessible     = false
  db_subnet_group_name    = aws_db_subnet_group.main.name
  vpc_security_group_ids  = [aws_security_group.rds_sg.id]
  backup_retention_period = 7
  deletion_protection     = false
  multi_az                = false
  tags = {
    Name        = "savorpalette-mysql"
    Environment = "production"
  }
}
