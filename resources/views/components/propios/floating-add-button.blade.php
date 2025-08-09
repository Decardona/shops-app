@props(['url'])

<div class="fixed bottom-8 right-4 z-10">
  <a href="{{ $url }}"
    class="flex h-12 w-12 cursor-pointer items-center justify-center rounded-full bg-yellow-400 text-2xl font-extrabold text-black shadow-md transition-colors duration-200 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
    <flux:icon name="plus" class="h-6 w-6" />
  </a>
</div>
