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


function ProductUpdate () {

    const [product,setProduct] = useState([]);
    const [companies,setCompanies] = useState([]);
    const [errors, setErrors] = useState({});
    const [product_name, setProduct_name] = useState('');
    const [company_id, setCompany_id] = useState('');
    const [price, setPrice] = useState('');
    const [stock, setStock] = useState('');
    const [comment, setComment] = useState('');
    const [img_path, setImg_path] = useState(null);

    useEffect(() => {
        const fetchProduct = async () => {
            try {

                const productId = window.location.pathname.split('/').pop();
                console.log(productId);
                const response = await fetch(`/api/products/updateProduct/${productId}`, {
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
                const product = data.product;
                const companies = data.companies;
                setProduct(product);
                setCompanies(companies);
                setProduct_name(data.product.product_name);
                setCompany_id(data.product.company_id);
                setPrice(data.product.price);
                setStock(data.product.stock);
                setComment(data.product.comment);
                setImg_path(data.product.img_path);


            } catch (error){
                console.error('Fetch error:', error);
            }
        };
        fetchProduct();
    }, []);

    if (!product) {
        return <div>Loading...</div>;
    }

    const handleSubmit  = async (e)=> {
        e.preventDefault();

        try{
            const formData = new FormData();
            formData.append('product_name',product_name);
            formData.append('company_id',company_id);
            formData.append('price',price);
            formData.append('stock',stock);
            formData.append('comment',comment);
            if (img_path && img_path instanceof File) {
                formData.append('img_path', img_path);
            }

            console.log("FormData:", formData); // Log FormData

            const productId = window.location.pathname.split('/').pop();

            const response = await fetch(`/api/products/update/${productId}`,{
                method: 'POST',
                body: formData,
            });

            if(!response.ok){
                const errorData = await response.json();// サーバーから帰ってきた情報を入れる
                setErrors(errorData.errors || {}); // バリデーションエラーを設定
                console.log(errorData.errors);
                return;
            } else {
                window.location.href = '/';
            }

        } catch (error){
            console.error('Fetch error:', error);
        }
    }




    return(
        <>
        <div class="m-4">
            <h3>商品更新画面</h3>
        </div>


        <form onSubmit={handleSubmit} encType="multipart/form-data">
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="product_name"  class="form-label">商品名</label>
            <input class="form-control md-6" type="text" name="product_name" value={product_name} onChange={(e) => setProduct_name(e.target.value) } />
            {errors.product_name && <p className="text-danger">{errors.product_name[0]}</p>}
        </div>
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="company_id" class="form-label">メーカー名</label>
                <select class="form-select md-6" id="company_id" name="company_id" value={company_id} onChange={(e) => setCompany_id(e.target.value)}>
                    <option  value="">メーカーを選択</option>
                    {Array.isArray(companies) && companies.length > 0 ? (
                        companies.map((company) => (
                            <option key={company.id} value={company.id}>{company.company_name}</option>
                        ))
                    ) : (
                        <option key="no-companies" value="" disabled>No companies available</option>
                    )}
                </select>
            {errors.company_id && <p className="text-danger">{errors.company_id[0]}</p>}

        </div>
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="price" class="form-label">価格</label>
            <input class="form-control md-6" type="text" name="price" value={price} onChange={(e) => setPrice(e.target.value)}/>
            {errors.price && <p className="text-danger">{errors.price[0]}</p>}
        </div>
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="stock" class="form-label">在庫</label>
            <input class="form-control md-6" type="text" name="stock" value={stock} onChange={(e) => setStock(e.target.value)}/>
            {errors.stock && <p className="text-danger">{errors.stock[0]}</p>}
        </div>
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="comment" class="form-label">コメント</label>
            <textarea class="form-control md-6" type="text" name="comment" value={comment} onChange={(e) => setComment(e.target.value)}/>
            {errors.comment && <p className="text-danger">{errors.comment[0]}</p>}
        </div>
        <div class="col-md-4 ms-4 mt-4">
            <label htmlFor="img_path" class="form-label">画像</label>
            <input class="form-control md-6" type="file" name="img_path" onChange={(e) => setImg_path(e.target.files[0])}/>
            <div class="col-md-4 mt-2">
                <img alt="" src={`/storage/images/${product.img_path}`} style={{ width: '100px', height: '100px'}} />
            </div>
            {errors.img_path && <p className="text-danger">{errors.img_path[0]}</p>}
            </div>
        <div class="col-md-4 ms-4 mt-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-outline-primary me-md-2" href={`/detail/${product.id}`}>戻る</a>
                <button class="btn btn-primary" type="submit">登録</button>
            </div>
        </div>


            </form>

     </>
    )
}


const productUpdate = document.getElementById("product_update");
if (productUpdate) {
    const root = createRoot(productUpdate);
    root.render(<ProductUpdate />);
}

export default ProductUpdate;