/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { createRoot } from 'react-dom/client';
import { render } from 'react-dom';
import React, { useState, useEffect, useMemo } from "react";


function ProductDetail () {

    const [product,setProduct] = useState([]);

    useEffect(() => {
        const fetchProduct = async () => {
            try {

                const productId = window.location.pathname.split('/').pop();
                console.log(productId);
                const response = await fetch(`/api/products/detail/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                console.log('Fetched products:', data);
                setProduct(data);
            } catch (error){
                console.error('Fetch error:', error);
            }
        };
        fetchProduct();
    }, []);

    if (!product) {
        return <div>Loading...</div>;
    }



    return(
        <>
        <div class="m-4">
            <h3>商品詳細画面</h3>
        </div>

        <div class="col-md-4 ms-4">
        <table class="table">
                <tbody>
                        <tr>
                            <th >id</th><td>{product.id}</td>
                        </tr>
                        <tr class="align-middle">
                            <th>商品画像</th><td><img alt="" src={`/storage/images/${product.img_path}`} style={{ width: '100px', height: '100px'}} /></td>
                        </tr>
                        <tr>
                            <th>商品名</th><td>{product.product_name }</td>
                        </tr>
                        <tr>
                            <th>メーカー名</th><td>{product.company ? product.company.company_name : 'データがありません'}</td>
                        </tr>
                        <tr>
                            <th>価格</th><td>{product.price }円</td>
                        </tr>
                        <tr>
                            <th>在庫数</th><td>{product.stock}</td>
                        </tr>
                        <tr>
                            <th>コメント</th><td>{product.comment }</td>
                        </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-outline-primary me-md-2" href={"/"}>戻る</a>
                <a class="btn btn-primary" href={`/update/${product.id}`}>編集</a>
            </div>
            </div>
     </>
    )
}


const productDetail = document.getElementById("product_detail");
if (productDetail) {
    const root = createRoot(productDetail);
    root.render(<ProductDetail />);
}

export default ProductDetail;