#![cfg_attr(windows, feature(abi_vectorcall))] // we activate the abi_vectorcall for windows users
use ext_php_rs::prelude::*;

#[php_function]
pub fn rs_process(left: i32, right: i32) -> i32 {
    let mut this = 1;
    for x in 1..1000{
        for y in 1..1000{
            for z in 1..1000{
                this *= x * y / z;
            }
        }
    }
    print!("{:?}", this);
    ((left + (right * 770)) - left) * right
}

#[php_module]
pub fn get_module(module: ModuleBuilder) -> ModuleBuilder {
    module
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn it_works() {
        let result = rs_process(2, 2);
        assert_eq!(result, 4);
    }
}
