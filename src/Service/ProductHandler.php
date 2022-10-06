<?php

namespace App\Service;

class ProductHandler
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Coca-cola',
            'type' => 'Drinks',
            'price' => 10,
            'create_at' => '2021-04-20 10:00:00',
        ],
        [
            'id' => 2,
            'name' => 'Persi',
            'type' => 'Drinks',
            'price' => 5,
            'create_at' => '2021-04-21 09:00:00',
        ],
        [
            'id' => 3,
            'name' => 'Ham Sandwich',
            'type' => 'Sandwich',
            'price' => 45,
            'create_at' => '2021-04-20 19:00:00',
        ],
        [
            'id' => 4,
            'name' => 'Cup cake',
            'type' => 'Dessert',
            'price' => 35,
            'create_at' => '2021-04-18 08:45:00',
        ],
        [
            'id' => 5,
            'name' => 'New York Cheese Cake',
            'type' => 'Dessert',
            'price' => 40,
            'create_at' => '2021-04-19 14:38:00',
        ],
        [
            'id' => 6,
            'name' => 'Lemon Tea',
            'type' => 'Drinks',
            'price' => 8,
            'create_at' => '2021-04-04 19:23:00',
        ],
    ];


    /**
     * 计算商品总金额
     * @return int
     */
    public function GetTotalPrice(){
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $productPrice=$product['price']?:0;
            $totalPrice+=$productPrice;
        }
        return $totalPrice;
    }

    /**
     * 根据传入字段排序
     * @param string $type
     * @param string $sort
     * @return array|bool
     */
    public function SortBy($type='Dessert',$sort='Price'){
        $this->products=array_search($type,$this->products['type']);
        $sort=array_column($sort);
        $this->products=array_multisort($sort,'SORT_ASC','SORT_NUMERIC',$this->products,'');
        return $this->products;
    }

    /**
     * UnixTime 时间格式转换
     * @return array
     */
    public function ChangeToUnixTime(){
        foreach ($this->products as $product) {
            $product['create_at']=$product['create_at']?:'now';
            $product['create_at']=strtotime($product['create_at']);
        }
        return $this->products;
    }
}