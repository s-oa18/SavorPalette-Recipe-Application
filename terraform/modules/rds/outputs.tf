output "db_endpoint" {
  value = aws_db_instance.mysql.endpoint
}

output "db_identifier" {
  value = aws_db_instance.mysql.id
}