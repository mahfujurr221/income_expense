@extends('frontend.layouts.master')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f5f5;
    }

    .team-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .team-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 3rem;
        color: #333;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .team-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .team-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        transform: translateY(-4px);
    }

    .team-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .avatar {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        flex-shrink: 0;
    }

    .team-card-info h3 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        margin: 0 0 0.3rem 0;
    }

    .team-card-info p {
        color: #667eea;
        font-size: 0.9rem;
        margin: 0;
        font-weight: 500;
    }

    .btn-view {
        display: block;
        width: 100%;
        text-align: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
</style>

<div class="team-container">
    <h2 class="team-title">Meet Our Team</h2>
    <div class="team-grid">
        @foreach($employees as $emp)
        <div class="team-card">
            <div class="team-card-header">
                <div class="avatar">
                    {{ substr($emp['name'], 0, 1) }}
                </div>
                <div class="team-card-info">
                    <h3>{{ $emp['name'] }}</h3>
                    <p>{{ $emp['role'] }}</p>
                </div>
            </div>
            <a href="{{ route('frontend.member.show', $emp['id']) }}" class="btn-view">
                View Details
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection