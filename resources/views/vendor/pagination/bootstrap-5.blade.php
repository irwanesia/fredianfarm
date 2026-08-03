@if ($paginator->hasPages())
<nav style="display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 0">
  @if ($paginator->onFirstPage())
  <span style="padding:8px 14px;border:1px solid var(--line);border-radius:var(--radius);color:var(--text-soft);font-size:14px;cursor:default">&lsaquo;</span>
  @else
  <a href="{{ $paginator->previousPageUrl() }}" style="padding:8px 14px;border:1px solid var(--line);border-radius:var(--radius);color:var(--text);font-size:14px;text-decoration:none">&lsaquo;</a>
  @endif

  @foreach ($elements as $element)
    @if (is_string($element))
    <span style="padding:8px 10px;color:var(--text-soft);font-size:14px">{{ $element }}</span>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span style="padding:8px 14px;border:1px solid var(--green-primary);border-radius:var(--radius);background:var(--green-primary);color:#fff;font-size:14px;cursor:default;font-weight:600">{{ $page }}</span>
        @else
        <a href="{{ $url }}" style="padding:8px 14px;border:1px solid var(--line);border-radius:var(--radius);color:var(--text);font-size:14px;text-decoration:none">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
  <a href="{{ $paginator->nextPageUrl() }}" style="padding:8px 14px;border:1px solid var(--line);border-radius:var(--radius);color:var(--text);font-size:14px;text-decoration:none">&rsaquo;</a>
  @else
  <span style="padding:8px 14px;border:1px solid var(--line);border-radius:var(--radius);color:var(--text-soft);font-size:14px;cursor:default">&rsaquo;</span>
  @endif
</nav>
@endif
