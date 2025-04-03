<div class="card shadow interest-domain col-lg-3"
    style="background-color: {{ $bgColor }};
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;">
    <!-- Title -->
    <h3 style="font-size: 18px;
               font-weight: 900;
               color: white;

        font-family: var(--font-family);
               margin-bottom: 10px;
               text-align: left;">
        {{ $title }}
    </h3>
    <!-- Content container -->
    <div class="d-flex justify-content-between align-items-end" style="margin-top: 10px;">
        <!-- Subtitle/Text -->
        <p style="font-size: 16px;
                  color: white;
                  margin-bottom: 0;
                  flex: 1;
                  text-align: left;
                  word-wrap: break-word;">
            {!! $text !!}
        </p>
        <!-- Button/Icon -->
        <a href="{{ $actionUrl }}"
            style="background-color: white;
                  color: {{ $bgColor }};
                  padding: 8px;
                  border-radius: 10px;
                  text-align: center;
                  text-decoration: none;
                  font-size: 18px;
                  font-weight: bold;
                  margin-left: 10px;
                  width: 40px;
                  height: 40px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                  transition: background-color 0.3s ease;">
            <span><i class="fa fa-chevron-right"></i></span>
        </a>
    </div>
</div>
