terraform {
  required_providers {
    aws = {
        source = "Hashicorp/aws"
        version = "~>5.0"
    }
  }
}

 provider "aws" {
    region = "eu-west-1"
    
  }