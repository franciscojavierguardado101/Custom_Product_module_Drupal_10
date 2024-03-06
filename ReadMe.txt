my_product.info.yml: Similar to the previous examples, updated with the autoload 
section specifying the src folder for autoloading.
src/Entity/Product.php: Defines the Product entity class extending 
ContentEntityBase. It includes code for defining base fields, pre-creation logic, 
entity type information, and a custom method to format the product price as a string.
src/Product.module (optional): Similar to the previous examples, 
it defines hooks for creating the "product" bundle and avoids defining field 
information again, relying on the Product class definition.