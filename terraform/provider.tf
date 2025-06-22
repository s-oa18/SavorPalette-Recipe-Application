terraform {
  required_providers {
    aws = {
        source = "Hashicorp/aws"
        version = "~>5.0"
    }

    http = {
      source  = "hashicorp/http"
      version = "~> 3.0"
    }
  }
}

 provider "aws" {
    region = "eu-west-1"
    
  }