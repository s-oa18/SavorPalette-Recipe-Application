variable "aws_region" {}
variable "name_prefix" {}
variable "vpc_cidr" {}
variable "public_subnets" {
  type = list(string)
}
variable "private_subnets" {
  type = list(string)
}
variable "azs" {
  type = list(string)
}
variable "db_name" {}
variable "db_username" {}
variable "db_password" {
  sensitive = true
}
variable "cluster_name" {}






# variable "aws_region" {
#   default = "eu-west-1"
# }

# variable "name_prefix" {
#   default = "savorpalette"
# }

# variable "vpc_cidr" {
#   default = "10.0.0.0/16"
# }

# variable "public_subnets" {
#   default = ["10.0.1.0/24", "10.0.2.0/24"]
# }

# variable "private_subnets" {
#   default = ["10.0.3.0/24", "10.0.4.0/24"]
# }

# variable "azs" {
#   default = ["eu-west-1a", "eu-west-1b"]
# }

# variable "db_name" {
#   default = "savorpalette"
# }

# variable "db_username" {
#   default = "admin"
# }

# variable "db_password" {}
# variable "cluster_name" {
#   default = "savorpalette-cluster"
# }