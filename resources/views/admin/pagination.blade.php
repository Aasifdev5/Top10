<?php
// config
$link_limit = 8; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>
<style>
.pagination {
  text-align: center;
  margin: 50px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination a {
  color: black;
  float: left;
  padding: 2px 14px;
  text-decoration: none;
}

.pagination li.active {
  background-color: #FC3B56;
  border-radius: 50%;
  color: white;
}
</style>

@if ($paginator->lastPage() > 1)
    <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
        <li class="pagination__list{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="pagination__item--arrow  link" href="{{ $paginator->url($paginator->currentPage() - 1) }}" data-toggle="tooltip" title="Previous">
                <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/></svg>
                                                <span class="visually-hidden">page left arrow</span>
            </a>
        </li>
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($from < 1) {
            $from = 1;
            $to = $link_limit;
        }
        if ($to > $paginator->lastPage()) {
            $to = $paginator->lastPage();
            $from = $paginator->lastPage() - $link_limit + 1;
            if ($from < 1) {
                $from = 1;
            }
        }
        ?>
         @for ($i = $from; $i <= $to; $i++)
         <li class="pagination__list {{ ($paginator->currentPage() == $i) ? 'pagination__list--current' : '' }}">
             <a class="pagination__item link {{ ($paginator->currentPage() == $i) ? 'pagination__item--current' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
         </li>
     @endfor
        <li class="pagination__list {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="pagination__item--arrow  link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" data-toggle="tooltip" title="Next">
                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg>
                <span class="visually-hidden">page right arrow</span>
            </a>
        </li>
    </ul>
@endif
