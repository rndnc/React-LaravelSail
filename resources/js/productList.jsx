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
import React, { useState, useEffect } from "react";


function ProductList () {

    const [product,setProduct] = useState([]);
    const [companies,setCompanies] = useState([]);
    const [searchParams,setSearchParams] = useState({
        product_name:'', company_id: '', lowPrice: '', upperPrice: '', lowStock: '',upperStock: ''
    });
    const [sortDirection,setSortDirection] = useState(['asc']);

    
        const fetchProduct = async () => {
            try {
                const response = await fetch('/api/products', {
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

                const product = data.product;
                const companies = data.companies;
                console.log(product);
                console.log(companies);
                setProduct(product);
                setCompanies(companies)

            } catch (error){
                console.error('Fetch error:', error);
            }
        };

    useEffect(() => {
        fetchProduct();
    }, []);

    const handleInputSearch  = (e)=> {
        const {id,value} = e.target;

        setSearchParams(prevState => ({
            ...prevState,
            [id]: value
        }));
    }

    const handleSearch  = async ()=> {
        
        try {
            const response = await fetch('/api/products/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({searchParams}),
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            console.log('Data received:', data);

            const product = data.product;
            const companies = data.companies;
            console.log(product);
            console.log(companies);
            setProduct(product);
            setCompanies(companies)

        } catch (error){
            console.error('Fetch error:', error);
        }

    }

    const handleDelete  = async (productId)=> {
        
        try {
            const response = await fetch(`/api/products/delete/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({}),
            });
            if (response.ok) {
                console.log('Delete successfu');
                fetchProduct();
            } else {
                throw new Error('Network response was not ok');
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }

    }

    const handleSort = (field,field2) => {
        const sortedProduct = [...product].sort((a,b) => {

            const aValue = field2 ? a[field2][field] : a[field];
            const bValue = field2 ? b[field2][field] : b[field];

            if (aValue < bValue){
                return sortDirection === 'asc' ? -1 : 1;
            } else if (aValue > bValue) {
                return sortDirection === 'asc' ? 1 : -1;
            }
            return 0;
        });
        setProduct(sortedProduct);

        setSortDirection(sortDirection === 'asc' ? 'desc' : 'asc');
    }

    return(
        <>
        <div class="m-4">
            <h2>商品一覧画面</h2>
        </div>


 <div class="container mb-4">

    <div class="row mb-1 mt-3">
        <div class="col-md-4">
            <input class="form-control" id="product_name" type="text" placeholder="検索キーワード" onChange={handleInputSearch} />
        </div>
        <div class="col-md-3">
            <input class="form-control" id="upperPrice" type="text" placeholder="上限価格" onChange={handleInputSearch} />
        </div>
        <div class="col-md-3 ">
            <input class="form-control" id="upperStock" type="text" placeholder="上限在庫" onChange={handleInputSearch} />
        </div>
        <div class="col-md-3">

        </div>
    </div>

    <div class="row">
    <div class="col-md-4">
        <select class="form-select" id="company_id" name="company_id" onChange={handleInputSearch}>
        <option value="">メーカーを選択</option>
        {Array.isArray(companies) && companies.length > 0 ? (
            companies.map((company) => (
                <option key={company.id} value={company.id}>{company.company_name}</option>
            ))
        ) : (
            <option key="no-companies" value="" disabled>No companies available</option>
        )}
        </select>
    </div>
    <div class="col-md-3">
            <input class="form-control" id="lowPrice" type="text" placeholder="下限価格" onChange={handleInputSearch} />
        </div>
        <div class="col-md-3">
            <input class="form-control" id="lowStock" type="text" placeholder="下限在庫" onChange={handleInputSearch} />
        </div>
        <div class="col-auto d-flex align-items-end">
            <button class="btn btn-outline-primary" onClick={handleSearch}>検索</button>
        </div>
    </div>
    </div>




        <div>
        <table class="table table-striped">
            <thead >
                <tr>
                    <th onClick={() => handleSort('id')}>ID</th>
                    <th onClick={() => handleSort('product_name')}>商品名</th>
                    <th>画像</th>
                    <th onClick={() => handleSort('price')}>金額</th>
                    <th onClick={() => handleSort('stock')}>在庫数</th>
                    <th onClick={() => handleSort('company_name','company')}>会社名</th>
                    <th><a class="btn btn-primary" href={`/regist`}>新規登録</a></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="align-middle">
                {product.map((product) => {
                    return(
                        <tr key={product.id}>
                            <th>{product.id}</th>
                            <th>{product.product_name}</th>
                            <th><img alt="" src={`/storage/images/${product.img_path}`} style={{ width: '100px', height: '100px'}} /></th>
                            <th>{product.price}</th>
                            <th>{product.stock}</th>
                            <th>{product.company.company_name}</th>
                            <th><a class="btn btn-outline-primary" href={`/detail/${product.id}`}>詳細</a></th>
                            <th><button class="btn btn-outline-primary" onClick={() => handleDelete(product.id)} >削除</button></th>
                        </tr>
                    );
            })}
            </tbody>
        </table>
        </div>
        </>
    )
}





const productList = document.getElementById("product_list");
if (productList) {
    const root = createRoot(productList);
    root.render(<ProductList />);
}

export default ProductList;