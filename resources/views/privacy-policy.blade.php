@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="page-wrapper">
    <div class="container" style="padding: 50px 20px; max-width: 800px;">
        <h1>Privacy Policy</h1>
        <p><strong>Last updated:</strong> {{ date('Y-m-d') }}</p>
        
        <h2>Introduction</h2>
        <p>This Privacy Policy describes how Food Delivery App collects, uses, and protects your personal information when you use our service.</p>
        
        <h2>Information We Collect</h2>
        <p>We collect information that you provide directly to us, including:</p>
        <ul>
            <li>Name and contact information</li>
            <li>Email address</li>
            <li>Phone number</li>
            <li>Delivery address</li>
            <li>Order history</li>
        </ul>
        
        <h2>How We Use Your Information</h2>
        <p>We use the information we collect to:</p>
        <ul>
            <li>Process and deliver your orders</li>
            <li>Communicate with you about your orders</li>
            <li>Improve our services</li>
            <li>Send you promotional offers (with your consent)</li>
        </ul>
        
        <h2>Data Security</h2>
        <p>We implement appropriate security measures to protect your personal information.</p>
        
        <h2>Contact Us</h2>
        <p>If you have questions about this Privacy Policy, please contact us at: support@fooddeliveryapp.com</p>
    </div>
</div>
@endsection

